<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

    <style>
       body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}






/* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}

*{
    margin: 0;
    padding: 0;
}
.rate {
    float: left;
    height: 46px;
    padding: 0 10px;
}
.rate:not(:checked) > input {
    position:absolute;
    top:-9999px;
}
.rate:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:30px;
    color:#ccc;
}
.rate:not(:checked) > label:before {
    content: '★ ';
}
.rate > input:checked ~ label {
    color: #ffc700;    
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
    color: #deb217;  
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
    color: #c59b08;
}
     table tr:not(:first-child){
                cursor: pointer;transition: all .25s ease-in-out;
            }
            table tr:not(:first-child):hover{background-color: #ddd;}

    </style>

    <script >
        function ddlselect()
{
    var d=document.getElementById("brinto");
    var displaytext=d.options[d.selectedIndex].text;
    document.getElementById("gender").value=displaytext;
}

function ddlselect1()
{
    var d=document.getElementById("brinto1");
    var displaytext=d.options[d.selectedIndex].text;
    document.getElementById("type").value=displaytext;
}

function ddlselect2()
{
    var d=document.getElementById("brinto2");
    var displaytext=d.options[d.selectedIndex].text;
    document.getElementById("cost_basis").value=displaytext;
}
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}



 function addField (argument) {
            var myTable = document.getElementById("myTable");
            for(var i=1;i<myTable.rows.length;i++)
        {
        }
            var currentIndex = myTable.rows.length;
            var currentRow = myTable.insertRow(-1);

          //  var Checkone=document.createElement("checkbox");
           // Checkone.setAttribute("name", "chk" + currentIndex);

            var linksBox = document.createElement("input");
            linksBox.setAttribute("name", "rpname[]");
             linksBox.setAttribute("placeholder", "Name");
             linksBox.setAttribute("class", "form-control");
             linksBox.setAttribute("id", "rpname[]");

            var keywordsBox = document.createElement("input");
            keywordsBox.setAttribute("name", "max_people[]");
            keywordsBox.setAttribute("placeholder", "people");
            keywordsBox.setAttribute("class", "form-control");
            keywordsBox.setAttribute("id", "max_people[]");

            var violationsBox = document.createElement("input");
            violationsBox.setAttribute("name", "cost[]");
            violationsBox.setAttribute("placeholder", "cost");
            violationsBox.setAttribute("class", "form-control");
            violationsBox.setAttribute("id", "cost[]");

            var dateBox = document.createElement("input");
            dateBox.setAttribute("type", "date");
            dateBox.setAttribute("name", "from_date[]");
            dateBox.setAttribute("class", "form-control");
            dateBox.setAttribute("id", "from_date[]");


             var todateBox = document.createElement("input");
            todateBox.setAttribute("type", "date");
            todateBox.setAttribute("name", "to_date[]");
            todateBox.setAttribute("class", "form-control");
            todateBox.setAttribute("id", "to_date[]");



            var addRowBox = document.createElement("input");
            addRowBox.setAttribute("type", "button");
            addRowBox.setAttribute("value", "Add Room");
            addRowBox.setAttribute("onclick", "addField();");
            addRowBox.setAttribute("class", "button");

            var currentCell = currentRow.insertCell(-1);
            currentCell.appendChild(linksBox);//currentRow.insertCell(-1);
            //currentCell.appendChild(Checkone);

            

            currentCell = currentRow.insertCell(-1);
            currentCell.appendChild(keywordsBox);

            currentCell = currentRow.insertCell(-1);
            currentCell.appendChild(violationsBox);

            currentCell = currentRow.insertCell(-1);
            currentCell.appendChild(dateBox);

            currentCell = currentRow.insertCell(-1);
            currentCell.appendChild(todateBox);

            currentCell = currentRow.insertCell(-1);
            currentCell.appendChild(addRowBox);
        }
        function myFunction(x) {
  var x1 = document.getElementById("table").rows.length;
  var y=document.getElementById("table").rows[x.rowIndex].cells;
  document.getElementById("fname").value=y[0].innerHTML;
   document.getElementById("fpeople").value=y[1].innerHTML;
    document.getElementById("fcost").value=y[2].innerHTML;
}



</script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        @include('inc.navbar')
        <div class="container">
            @include('inc.message')
        @yield('content')
    </div>
    </div>
</body>
</html>