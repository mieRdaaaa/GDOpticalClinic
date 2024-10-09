<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>GD Optical Clinic</title>
    <link rel="shortcut icon" href="images/ico.png" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/>
  </head>

  <body>
    <!-- Section 1 -->
    <header class="w-full px-8 text-gray-700 bg-gray-200">
      <div class="container flex flex-col flex-wrap items-center justify-between py-5 mx-auto md:flex-row max-w-7xl">
        <div class="relative flex flex-col md:flex-row">
          <a href="index.php" class="flex items-center mb-5 font-medium text-gray-900 lg:w-auto lg:items-center lg:justify-center md:mb-0">
            <img src="images/mainlogo.png" alt="GD Optical Clinic Logo" class="h-12 w-auto mr-2">
            <span class="mx-auto text-3xl font-white leading-none text-blue-600 select-none font-bold">
              GD <span class="text-indigo-600"></span>
              <span class="mx-auto text-3xl font-black leading-none text-gray-900 select-none">Optical Clinic<span class="text-indigo-600"></span></span>
            </span>
          </a>
        </div>

        <div class="inline-flex items-center ml-5 space-x-6 lg:justify-end">
          <a href="pages/login.php" class="inline-flex items-center justify-center px-4 py-2 text-base font-medium leading-6 text-white whitespace-no-wrap bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600">
            LogIn
          </a>
        </div>
      </div>
    </header>

    <!-- Section 2 -->
    <main class="px-2 py-32" style="background-image: url('images/landbg.png'); background-size: cover; background-position: center;">
  <div class="container items-center max-w-6xl mx-auto px-8 xl:px-5 py-20">
    <div class="flex flex-wrap items-center sm:-mx-3">
      <div class="w-full md:w-1/2 md:px-3">
        <div class="w-full pb-6 space-y-6 sm:max-w-md lg:max-w-lg md:space-y-4 lg:space-y-8 xl:space-y-9 sm:pr-5 lg:pr-0 md:pb-0">
          <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-4xl lg:text-5xl xl:text-6xl">
            <span class="block xl:inline">"Check your vision for a</span>
            <span class="block text-white xl:inline">brighter future."</span>
          </h1>
        </div>
      </div>
      <div class="w-full md:w-1/2">
      <div class="w-full h-auto overflow-hidden rounded-md sm:rounded-xl shadow-lg">
  <img src="images/doc.png" alt="Main Logo" class="w-full h-auto">
</div>

      </div>
    </div>
  </div>
</main>


    <hr class="border-t border-gray-300" />

    <!-- Section 3 -->
    <div class="py-20 bg-gray-100">
    <div class="container mx-auto px-6 md:px-12 xl:px-32">
      <div class="mb-16 text-center">
        <h2 class="mb-4 text-2xl black-300 font-bold md:text-4xl">Members:</h2>
      </div>
      <div class="grid gap-12 items-center md:grid-cols-3">
        <div class="space-y-4 text-center">
          <img class="w-64 h-64 mx-auto object-cover rounded-xl md:w-40 md:h-40 lg:w-64 lg:h-64" 
              src="images/members.png" alt="Hentoni Doe" loading="lazy" width="640" height="805">
          <div>
            <h4 class="text-2xl black-300">Jules Martin Enolva</h4>
          </div>
        </div>
        <div class="space-y-4 text-center">
          <img class="w-64 h-64 mx-auto object-cover rounded-xl md:w-40 md:h-40 lg:w-64 lg:h-64"  
              src="images/members.png" alt="Jonathan Doe" loading="lazy" width="1000" height="667">
          <div>
            <h4 class="text-2xl black-300">Ralph Justin Saransate</h4>
          </div>
        </div>
        <div class="space-y-4 text-center">
          <img class="w-64 h-64 mx-auto object-cover rounded-xl md:w-40 md:h-40 lg:w-64 lg:h-64" 
              src="images/members.png" alt="Anabelle Doe" loading="lazy" width="1000" height="667">
          <div>
            <h4 class="text-2xl text-black-300">Charliene Cabilando</h4>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
