<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <h3 class="text-center mb-5 mt-5">Infinite scroll laravel 8 using ajax</h3>
        <div class="row" id="data_temp">
        </div>
        <div class="ajax-load text-center" style="display:none">
            <i class="mdi mdi-48px mdi-spin mdi-loading"></i> Loading ...
        </div>
        <div class="no-data text-center mb-4" style="display:none">
            <b>No data - last page</b>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        let pages = 2;
        let current_page = 0;
        let bool = false;
        let lastPage ;
        $(window).scroll(function (){
          let  height = $(document).height();
           if($(window).scrollTop() + $(window).height() >= height && bool == false && lastPage > pages - 2){
           bool = true;
             $('.ajax-load').show();
             lazyLoad(pages)
             .then(() => {
                bool = false;
                pages++;
                if(pages - 2 == lastPage){
                 $('.no-data').show();
               }
           })
          }
        })
        function lazyLoad(page){
          return new Promise((resolve,reject) => {
            $.ajax({
               url: '?page='+page,
               type:'GET',
               beforeSend:function() {
              $('.ajax-load').show();
             }, 
             success :function (response){
               $('.ajax-load').hide();
               let html = '';
               for(let i = 0; i < response.data.data.length;i++){
                html += `
                   <div class="col-md-4 mb-3" >
                        <div class="card">
                           <div class="card-header">
                             Employee Title
                           </div>
                          <div class="card-body">
                             <table class="table">
                               <tr>
                               <th>Name</th>
                               <td>:</td>
                               <td>`+response.data.data[i].name+`</td>
                          </tr>
                         <tr>
                         <th>Phone</th>
                          <td>:</td>
                          <td>`+response.data.data[i].phone+`</td>
                       </tr>
                     </table>
                   </div>
             </div>
        </div>
        `;
        }
              $('#data_temp').append(html);
           resolve();
        }
        });
        })
        }
        loadData(1);
        function loadData(page){
            $.ajax({
               url: '?page='+page,
               type:'GET',
               beforeSend:function() {
                 $('.ajax-load').show();
               },
               success :function (response){
                   $('.ajax-load').hide();
                   lastPage = response.data.last_page;
                   console.log(response);
                  let html = '';
                for(let i = 0; i < response.data.data.length;i++){
                    html += `
                      <div class="col-md-4 mb-3" >
                        <div class="card">
                            <div class="card-header">
                            Employee Title
                            </div>
           <div class="card-body">
                <table class="table">
                   <tr>
                       <th>Name</th>
                        <td>:</td>
                        <td>`+response.data.data[i].name+`</td>
                     </tr>
                     <tr>
                      <th>Phone</th>
                        <td>:</td>
                       <td>`+response.data.data[i].phone+`</td>
                      </tr>
                 </table>
             </div>
             </div>
        </div>`;
              }
              $('#data_temp').html(html);
           }
          });
        }
        </script>
</body>

</html>
