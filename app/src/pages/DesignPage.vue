<template>
  <!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8" />

      <meta name="viewport" content="width=device-width, initial-scale=1.0" />

      <title>Companies</title>
    </head>

    <body>
      <header>
        <h1>Site Name</h1>
      </header>

      <main>
        <section class="filters">
          <button>Filter 1</button>

          <button>Filter 2</button>

          <button>Filter 3</button>
        </section>

        <section class="company-list">
          <!-- Company cards will be inserted here -->
        </section>
      </main>

      <footer>
        <!-- Add your footer content here -->

        <p>© 2023 Your Company</p>
      </footer>
    </body>
  </html>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  name: "ErrorNotFound",
});
</script>
<style>
* {
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;

  margin: 0;

  padding: 0;
}

header {
  background-color: #003366;

  color: white;

  padding: 1rem;
}

main {
  display: flex;

  flex-wrap: wrap;

  margin: 0 auto;

  max-width: 1200px;

  padding: 1rem;
}

.filters {
  display: flex;

  flex-wrap: wrap;

  justify-content: space-between;

  margin-bottom: 1rem;

  width: 100%;
}

.filters button {
  background-color: #f2f2f2;

  border: none;

  border-radius: 5px;

  font-size: 0.8rem;

  padding: 0.5rem 1rem;

  margin-bottom: 0.5rem;

  cursor: pointer;
}

.company-list {
  display: flex;

  flex-wrap: wrap;

  justify-content: space-between;

  width: 100%;
}

.company-card {
  background-color: white;

  border: 1px solid #ccc;

  border-radius: 5px;

  box-shadow: 1px 1px 2px #ccc;

  flex-basis: calc(31% - 10px);

  margin-bottom: 1rem;

  overflow: hidden;
}

.company-card img {
  width: 100%;
}

.company-info {
  padding: 1rem;
}

.company-name {
  font-size: 1.2rem;

  font-weight: bold;

  margin-bottom: 0.5rem;
}

.company-description {
  font-size: 0.9rem;

  margin-bottom: 0.5rem;
}

footer {
  background-color: #003366;

  color: white;

  padding: 1rem;

  text-align: center;
}
</style>
