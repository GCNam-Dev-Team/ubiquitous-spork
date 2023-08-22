<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="The Last Code Bender">
  <meta name="author" content="Agostinho Silva">

  <title>Gondwana Collection</title>

  <!--GOOGLE AJAX JQUERY-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


  <!--FONT AWESOME FAN SPIN ANIMATION-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!--BOOTSTRAP 5 CDN PLUGIN-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

  <style>
    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .b-example-divider {
      width: 100%;
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }



    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
    }

    .nav-scroller .nav {
      display: flex;
      flex-wrap: nowrap;
      padding-bottom: 1rem;
      margin-top: -1px;
      overflow-x: auto;
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }

    body {
      background: linear-gradient(-45deg, #dcb182, #97571b, #ca9765, #ce9152);
      ;
      background-size: 400% 400%;
      animation: gradient 15s ease infinite;
      height: 100vh;
    }

    @keyframes gradient {
      0% {
        background-position: 0% 50%;
      }

      50% {
        background-position: 100% 50%;
      }

      100% {
        background-position: 0% 50%;
      }
    }

    /*BUTTON LOADER CSS STYLE START*/

    .buttonload {


      color: white;
      /* White text */
      padding: 12px 24px;
      /* Some padding */
      font-size: 16px;
      /* Set a font-size */
    }

    /* Add a right margin to each icon */
    .fa {
      margin-left: -12px;
      margin-right: 8px;
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="cover.css" rel="stylesheet">
</head>

<body class="d-flex h-100 text-center text-bg-dark">
  <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check2" viewBox="0 0 16 16">
      <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
    </symbol>
    <symbol id="circle-half" viewBox="0 0 16 16">
      <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z" />
    </symbol>
    <symbol id="moon-stars-fill" viewBox="0 0 16 16">
      <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z" />
      <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z" />
    </symbol>
    <symbol id="sun-fill" viewBox="0 0 16 16">
      <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z" />
    </symbol>
  </svg>


  <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="mb-auto">
      <div>

        <nav class="nav nav-masthead justify-content-center float-md-end">

        </nav>
      </div>
    </header>

    <main class="px-3">

      <div class="row ">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <div class="card ">
            <h5 class="card-header"><img src="https://gondwana-collection.com/hs-fs/hubfs/Gondwana-Collection-Logo-1.png?width=252&height=64&name=Gondwana-Collection-Logo-1.png" width="200px" height="60px" /></h5>
            <div class="card-body">
              <h5 class="card-title">Your next destination awaits!</h5>
              <div class="input-group input-group-sm mb-3 main_panel">
                <span class="input-group-text" id="inputGroup-sizing-sm">Unit Name</span>
                <!--<input id="unit_name" type="text" class="form-control"  aria-describedby="inputGroup-sizing-sm">-->
                <select class="form-select form-select-sm" id="unit_name" name="unit_name">
                  <option selected>Select Unit Name</option>
                  <option value="Kalahari Farmhouse">Kalahari Farmhouse</option>
                  <option value="Klipspringer Camps">Klipspringer Camps</option>

                </select>
              </div>

              <!--Arrival Input Div-->
              <div class="input-group input-group-sm mb-3 main_panel">
                <span class="input-group-text" id="inputGroup-sizing-sm">Arrival</span>
                <input type="date" id="arrival" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
              </div>

              <!--Departure Input Div-->
              <div class="input-group input-group-sm mb-3 main_panel">
                <span class="input-group-text" id="inputGroup-sizing-sm">Departure</span>
                <input type="date" id="departure" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
              </div>

              <!-- Occupants Input Div-->
              <div class="input-group input-group-sm mb-3 main_panel">
                <span class="input-group-text" id="inputGroup-sizing-sm">Occupants:</span>
                <input type="number" id="occupants" placeholder="Number of occupants" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
              </div>


              <!--Age Input Div-->
              <div class="input-group input-group-sm mb-3 main_panel" id="ageInputDiv">
                <span class="input-group-text" style="color:grey" id="inputGroup-sizing-sm"><b>Occupants Ages</b></span>
                <input type="number" id="ages" class="form-control" name="ages[]" placeholder="Ages" value=''>

                <button id="addAgeBtn" class="btn btn-sm btn-dark text-white">+</button>
              </div>



              <button type="button" id="searchBtn" style="background-color:#ca9765" class="btn text-white searchBtn buttonload"><i id='btnIcon' class=""></i>Search</button>
              <!--RESULT CARD START-->
              <div class="card mt-5 result_panel" style="display:none">
                <div class="card-body">
                  <h6 class='card-title'>Search Result:</h6>
                  <ul class="list-group">


                    <!--Unit Name List Item-->
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      Unit Name:
                      <span id="unit_name_result" class="badge" style="background-color:#ca9765"></span>
                    </li>


                    <!--Daily Rate List Item-->
                    <li class="list-group-item d-flex justify-content-between align-items-center">

                      <h6><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="grey" class="bi bi-tag" viewBox="0 0 16 16">
                          <path d="M6 4.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm-1 0a.5.5 0 1 0-1 0 .5.5 0 0 0 1 0z" />
                          <path d="M2 1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 1 6.586V2a1 1 0 0 1 1-1zm0 5.586 7 7L13.586 9l-7-7H2v4.586z" />
                        </svg>&nbsp;Daily Rate:</h6>
                      <span id="rate" class="badge" style="background-color:#ca9765">2</span>
                    </li>

                    <!--Date Range List Item-->
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <h6><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar2-check" viewBox="0 0 16 16">
                          <path d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                          <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z" />
                          <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z" />
                        </svg>&nbsp;Date Range:</h6>
                      <span id="date_range" class="badge" style="background-color:#ca9765"><i>2023-04-23:2023-05-12</i></span>
                    </li>


                    <!--Amount Due List Item-->
                    <li class="list-group-item d-flex justify-content-between align-items-left">

                      <h6> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin text-secondary" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z" />
                          <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z" />
                          <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z" />
                          <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z" />

                        </svg>&nbsp; Amount Due:</h6>
                      <span id="amount_due" class="badge  " style="background-color:#ca9765"></span>
                    </li>



                    <!--Availability List Item-->
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      Availability
                      <i id="status" class="fa fa-check text-success" style="font-size:20px;"></i>
                    </li>


                    <!--End Of List-->
                  </ul>
                  <button type="button" id="modifyBtn" class="btn btn-sm btn-secondary text-white mt-3 modifyBtn">Modify search</button>

                </div>
                <div class='card-footer'>
                  <ul class="nav justify-content-center">
                    <li class="nav-item">
                      <a class="nav-link active" style='font-size:11px; color:#ca9765' href="https://gondwana-collection.com/promotions-namibia">Promotions</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" style='font-size:11px; color:#ca9765' href="https://gondwana-collection.com/card">Discount Plans</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" style='font-size:11px; color:#ca9765' href="https://gondwana-collection.com/en/about-us">Why Us?</a>
                    </li>

                  </ul>
                </div>
              </div>
              <!--END RESULT CARD-->
            </div>
          </div>
        </div>
        <div class="col-md-3"></div>

      </div>



    </main>

    <footer class="mt-auto text-white-50">
      <p>Designed and Developed by , <a href="https://www.linkedin.com/in/agostinho-da-silva-24a059206/" class="text-white"> Agostinho Silva</a> --"The Last Code Bender"</p>
    </footer>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/@popperjs/core@2"></script>
  <script src="https://unpkg.com/tippy.js@6"></script>
  <script src="js/custom_js.js"></script>
  <script>
    tippy("#addAgeBtn", {
      content: "Add more ages!",
      arrow: true,
    });
  </script>
</body>

</html>