<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Dog;
use App\Models\DogClassifier;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DogController extends BaseController
{
    public function getBreeds()
    {
        try {
            $result = Dog::with('classification')->get();
            $clasifications = DogClassifier::get();
            foreach ($clasifications as $clas) {
                $clas->value = $clas->name;
                $clas->label = $clas->name;
            }

            foreach ($result as $res) {
                //asi obtenemos el nombre de la clasificacion de la raza de perro
                $res->clasification = $res->classification->name;
                $res->photo = env('APP_URL') . '/storage/dogs/' . $res->photo;
            }
            $success['breeds'] = $result;
            $success['clasifications'] = $clasifications;
            return $this->sendResponse($success, 'Se ha realizado la busqueda.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function filterBreed(Request $request)
    {
        try {
            $filters = $request->post();
            $query = DB::table('dogs');
            $query->join('dog_classifiers', 'dogs.classifier_id', '=', 'dog_classifiers.id');
            $query->select(
                'dogs.breed',
                'dogs.hair',
                'dogs.size',
                'dogs.photo',
                'dog_classifiers.name',
                'dog_classifiers.id',
            );
            // se arma el query con querybuilder
            $query->where(function ($query) use ($request, $filters) {
                if (array_key_exists('breed', $filters)) $query->where('dogs.breed', $filters['breed']);
                if (array_key_exists('hair', $filters)) $query->where('dogs.hair', $filters['hair']);
                if (array_key_exists('size', $filters)) $query->where('dogs.size', $filters['size']);
                if (array_key_exists('classifier_id', $filters)) $query->where('dog_classifiers.id', $filters['classifier_id']);
            });
            $query->orderBy('dogs.breed', 'desc');
            $query->groupBy(
                'dogs.id',
                'dogs.breed',
                'dogs.hair',
                'dogs.size',
                'dogs.photo',
                'dog_classifiers.name',
                'dog_classifiers.id',
            );
            $result =  $query->get();
            $breeds = $result;
            foreach ($breeds as $clas) {
                $clas->clasification = $clas->name;
            }
            foreach ($breeds as $bree) {
                $bree->photo = env('APP_URL') . '/storage/dogs/' . $bree->photo;
            }
            $success['breeds'] = $breeds;
            return $this->sendResponse($success, 'Se ha realizado la busqueda.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function updateBreed(Request $request)
    {
        try {
            if ($user = $request->user()) {
                if ($user->role != 'Admin')
                    return $this->sendError('Desautorizado.', ['error' => 'Error de usuario, desautarizado.']);
                DB::beginTransaction();
                $dog = Dog::find($request->id)->first();

                if (isset($request->breed)) {
                    $dog->breed = $request->breed;
                }
                if (isset($request->size)) {
                    $dog->size = $request->size;
                }
                if (isset($request->hair)) {
                    $dog->hair = $request->hair;
                }

                if (isset($request->classifier_id)) {
                    $dog->classifier_id = $request->classifier_id;
                }

                $file = $request->photo;
                if ($file && $file != 'null') {
                    if (File::exists(env('APP_URL') . '/storage/dogs/' . $dog->photo)) {
                        File::delete(env('APP_URL') . '/storage/dogs/' . $dog->photo);
                    }
                    $ext = $file->extension();
                    $path = 'storage/dogs/';
                    $file->move(public_path($path), "/" . $request->breed . $ext);
                    $dog->photo = $dog->breed . $ext;
                }
                $dog->save();
                $dog->refresh();
                $success['user'] = $user;
                $success['dog'] = $dog;
                DB::commit();
                return $this->sendResponse($success, 'Raza de perro editada con exito.');
            }
            return $this->sendError('Desautorizado.', ['error' => 'Error de usuario, desautarizado.']);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function createBreed(Request $request)
    {
        try {
            if ($user = $request->user()) {
                if ($user->role != 'Admin')
                    return $this->sendError('Desautorizado.', ['error' => 'Error de usuario, desautarizado.']);
                DB::beginTransaction();
                $messages = [
                    'uploaded' => 'La foto debe ser de hasta 1.5mb.',
                    'mimes' => 'La foto debe ser de tipo jpeg, jpg o png',
                ];

                $validator = Validator::make(
                    $request->all(),
                    [
                        'breed' => 'required',
                        'size' => 'required',
                        'hair' => 'required',
                        'classifier_id' => 'required',
                        'photo' => 'file|max:1536|mimes:jpeg,jpg,png',
                    ],
                    $messages
                );

                if ($validator->fails()) {
                    return $this->sendError('Error validation', $validator->errors());
                }
                $dog = new Dog();
                $file = $request->photo;
                if ($file) {
                    $ext = $file->extension();
                    $path = 'storage/dogs';
                    $file->move(public_path($path), "/" . $request->breed . '.' . $ext);
                    // guardamos solo el nombre de la foto, sin la ruta completa
                    $dog->photo = $request->breed . '.' . $ext;
                }
                $dog->breed = $request->breed;
                $dog->hair = $request->hair;
                $dog->size = $request->size;
                $dog->classifier_id = $request->classifier_id;
                $dog->save();
                // le hacemos un refresh para obtener la data del objeto
                $dog->refresh();

                $success['user'] = $user;
                $success['dog'] = $dog;
                DB::commit();
                return $this->sendResponse($success, 'Raza de perro creada con exito.');
            }
            return $this->sendError('Desautorizado.', ['error' => 'Error de usuario, desautarizado.']);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function deleteBreed(Request $request)
    {
        try {
            if ($user = $request->user()) {
                if ($user->role != 'Admin')
                    return $this->sendError('Desautorizado.', ['error' => 'Error de usuario, desautarizado.']);
                DB::beginTransaction();
                $dog = Dog::find($request->id)->first();
                if ($dog) {
                    DB::table('dogs')
                        ->where('id', (int)$request->id)
                        ->delete();
                    DB::commit();

                    $breeds = Dog::with('classification')->get();
                    foreach ($breeds as $res) {
                        //asi obtenemos el nombre de la clasificacion de la raza de perro
                        $res->clasification = $res->classification->name;
                        $res->photo = env('APP_URL') . '/storage/dogs/' . $res->photo;
                    }
                    $success['breeds'] = $breeds;
                    return $this->sendResponse($success, 'Raza de perro eliminada con exito.');
                }
                return $this->sendError('Desautorizado.', ['error' => 'Error de usuario, desautarizado.']);
            }
            return $this->sendError('Desautorizado.', ['error' => 'Error de usuario, desautarizado.']);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
