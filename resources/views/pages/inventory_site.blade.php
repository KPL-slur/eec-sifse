<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Print</title>
</head>
<body style="font-family:'Times New Roman', Times, serif;">
    <img class="mT-30 mL-20" src="{{ asset('material') }}/img/kop.png" alt="image" style="width:300px !important;">
    <h4 class="c-grey-900 text-center mT-40 mB-0"><b>PT. Era Elektra Corpora Indonesia</b></h4>
    <h4 class="c-grey-900 text-center mB-50"><b>Inventory Site</b></h4>
    <div class="text-center">
      <p id="demo"></p>
      <script>
        var d = new Date();
        document.getElementById("demo").innerHTML = d;
      </script>
    </div>
    <div class="row">
        <div class="col-md-12">
          <div class="card ">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table tablesorter " id="">
                    <thead class=" text-primary">
                    <tr class="text-center">
                      <th scope="col">#</th>
                      <th scope="col">Sparepart</th>
                      <th scope="col">Part Number</th>
                      <th scope="col">Serial Number</th>
                      <th scope="col">Installed Date</th>
                      <th scope="col">Expired Date</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    @foreach ($stocks as $stk)
                      <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$stk->nama_barang}}</td>
                        <td>{{$stk->part_number}}</td>
                        <td>{{$stk->serial_number}}</td>
                        <td>{{$stk->tgl_masuk}}</td>
                        <td>{{$stk->expired}}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <script type="text/javascript">
        window.print();
      </script>

      <footer class="footer-export fixed-bottom text-center">
        <p class="mB-0">Head Office : Eightyeight@Kasablanka Tower A 26D floor. Jl. Raya Casablanca Kav. 88 Jakarta Selatan - 12870</p>
        <p class="mB-0">Operational Office : Grand Palace Rukan A-16. Jl. Benyamin Suaeb No.5 - Kemayoran. Jakarta Pusat - 10630</p>
        <p>Phone : 62-21-22606878, Email : eecindonesia@eecindonesia.co.id</p>
      </footer>

</body>
</html>