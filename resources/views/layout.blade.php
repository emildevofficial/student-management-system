<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <!-- Load Tailwind via CDN (no build step required for development) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-p6O1XqVhVQ4y0F+KxQp7z3Qp1nWQp6K1Z6Zj1n1p6k2QW3V6f5Zb1pO6k1pQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <script>
      // configure Tailwind (custom font)
      tailwind.config = {
        theme: {
          extend: {
            fontFamily: {
              sans: ['Poppins', 'ui-sans-serif', 'system-ui']
            }
          }
        }
      }
    </script>

    <style>
        /* The side navigation menu */
.sidebar {
  margin: 0;
  padding: 0;
  width: 200px;
  background-color: #f1f1f1;
  position: fixed;
  height: 100%;
  overflow: auto;
}

/* Sidebar links */
.sidebar a {
  display: block;
  color: black;
  padding: 16px;
  text-decoration: none;
}

/* Active/current link */
.sidebar a.active {
  background-color: #04AA6D;
  color: white;
}

/* Links on mouse-over */
.sidebar a:hover:not(.active) {
  background-color: #555;
  color: white;
}

/* Page content. The value of the margin-left property should match the value of the sidebar's width property */
div.content {
  margin-left: 200px;
  padding: 1px 16px;
  height: 1000px;
}

/* On screens that are less than 700px wide, make the sidebar into a topbar */
@media screen and (max-width: 700px) {
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
  .sidebar a {float: left;}
  div.content {margin-left: 0;}
}

/* On screens that are less than 400px, display the bar vertically, instead of horizontally */
@media screen and (max-width: 400px) {
  .sidebar a {
    text-align: center;
    float: none;
  }
}

  :root{
    --sidebar-bg:#f8fafc;
    --accent:#0d6efd;
    --muted:#6c757d;
  }
  body{font-family:Inter,ui-sans-serif,system-ui,Arial,Helvetica,sans-serif}
  .navbar-brand h2{font-size:1.25rem;margin:0}

/* The side navigation menu */
.sidebar {
  margin: 0;
  padding: 0;
  width: 220px;
  background-color: var(--sidebar-bg);
  position: fixed;
  height: 100%;
  overflow: auto;
  border-right:1px solid rgba(0,0,0,0.04);
}

/* Sidebar links */
.sidebar a {
  display: block;
  color: #333;
  padding: 14px 18px;
  text-decoration: none;
  border-left:4px solid transparent;
  transition:all .15s ease;
}

/* Active/current link */
.sidebar a.active {
  background-color: #fff;
  color: var(--accent);
  border-left-color: var(--accent);
  font-weight:600;
}

/* Links on mouse-over */
.sidebar a:hover:not(.active) {
  background-color: rgba(13,110,253,0.04);
  color: var(--accent);
}

/* Page content. The value of the margin-left property should match the value of the sidebar's width property */
div.content {
  margin-left: 220px;
  padding: 1rem 1.25rem;
  min-height: 100vh;
}

/* On screens that are less than 700px wide, make the sidebar into a topbar */
@media screen and (max-width: 700px) {
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
  .sidebar a {float: left;}
  div.content {margin-left: 0;padding:1rem}
}

/* On screens that are less than 400px, display the bar vertically, instead of horizontally */
@media screen and (max-width: 400px) {
  .sidebar a {
    text-align: center;
    float: none;
  }
}

  </style>
  <!-- SweetAlert2 for nicer toasts/alerts -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class ="container">
    <div class="row">
        <div class="col-md-12">
          <nav class="bg-white border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
              <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                  <a class="navbar-brand" href="#"><h2 class="text-lg font-semibold">Student Management</h2></a>
                </div>
              </div>
            </div>
          </nav>
</div>
</div>

<div class="row">
  <div class="col-md-3">
              <!-- The sidebar -->
<div class="sidebar">
<a class="active" href="{{ route('dashboard') }}">Dashboard</a>
<a href="{{ url('/students') }}">Student</a>
<a href="{{ url('/teachers') }}">Teacher</a>
            <a href="{{ url('/courses') }}">Courses</a>
            <a href="{{ url('/enrollment') }}">Enrollment</a>
            <a href="{{ url('/payments') }}">Payment</a>
            </div>
  </div>
  <div class="col-md-9 content">
    @yield('content')
  </div>
    </div>
 </div>
  @include('partials.flash')

  <script>
    // optional JS utilities
    document.addEventListener('DOMContentLoaded', function(){
      const flash = document.querySelector('#flash-data');
      if (flash){
        const msg = flash.dataset.message;
        if (msg) {
          Swal.fire({
            toast:true, position:'top-end', showConfirmButton:false, timer:3500, icon:'success', title:msg
          });
        }
      }
    })
  </script>
  </body>
</html>
