<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

.titulo{
    display: flex;
    justify-content: center;
    text-align: center;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}

.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 40%;
  margin-bottom: 20px;
}
.div-cards{
    display: flex;
    justify-content: space-around;
}

.container {
  padding: 2px 16px;
}
</style>
</head>
<body>

<h1 class="titulo">Reporte de usuarios</h1>
<div class="div-cards">
    <div class="card">
        <div class="container">
          <h4><b>Total de usuarios:</b></h4> 
          <p> {{$users->count()}}</p> 
        </div>
    </div>
</div>

<table id="customers">
  <tr>
    <th>Nombre</th>
  </tr>
  @foreach ($users as $user)
  <tr>
    <td>{{$user->name}}</td>
  </tr>
  @endforeach
</table>

</body>

