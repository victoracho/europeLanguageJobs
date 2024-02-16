<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Dog;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DogController extends BaseController
{
    public function getBreeds(Request $request)
    {
        try {
            $result = Dog::with('classification')->get();
            foreach ($result as $res) {
                $res->clasification = $res->classification->name;
                $res->photo = $res->photo;
            }
            $success['breeds'] = $result;
            return $this->sendResponse($success, 'Se ha realizado la busqueda.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function filterBreeds(Request $request)
    {
        try {
            $filters = $request->filters;
            $query = DB::table('dogs');
            $query->join('dogs_applications', 'dogs.classifier_id', '=', 'dogs_classifier.id');
            $query->select(
                'dogs.breed',
                'dogs.hair',
                'dogs.size',
                'dogs.photo',
                'dogs_classifiers.name',
            );
            // se arma el query con querybuilder
            $query->where(function ($query) use ($request, $filters) {
                if (array_key_exists('breed', $filters)) $query->where('dogs.breed', $filters['breed']);
                if (array_key_exists('hair', $filters)) $query->where('dogs.hair', $filters['hair']);
                if (array_key_exists('size', $filters)) $query->where('dogs.size', $filters['size']);
                if (array_key_exists('classifier_id', $filters)) $query->where('dogs_classifiers.id', $filters['classifier_id']);
            });
            $query->orderBy('users.breed', 'desc');
            $query->groupBy(
                'dogs.id',
                'dogs.breed',
                'dogs.hair',
                'dogs.size',
                'dogs.photo',
                'dogs_classifiers.name',
                'dogs_classifiers.name',
            );
            $result =  $query->get();
            $success['breeds'] = $result;
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
                if ($file) {
                    if (File::exists(public_path($user->application->curriculum))) {
                        File::delete(public_path($user->application->curriculum));
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
                return $this->sendResponse($success, 'Raza de perro creada con exito.');
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
                    'uploaded' => 'El curriculum debe pesar hasta 1,5mb.',
                    'mimes' => 'El curriculum debe ser de tipo  PDF',
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
                    $path = 'storage/dogs/';
                    $file->move(public_path($path), "/" . $request->breed . $ext);
                    // guardamos solo el nombre de la foto, sin la ruta completa
                    $dog->photo = $request->breed . $ext;
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
                    $success['dog'] = Dog::destroy($dog->id);
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
