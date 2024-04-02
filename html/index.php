<?php
session_start();
$params= $_SESSION['params'];
$nomM=$params[0];
$niveau = $params[1];
?>

<!DOCTYPE html>
<html>
 <head>
  <title>notes</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style>
  .box
  {
   max-width:600px;
   width:100%;
   margin: 0 auto;;
  }
  </style>
 </head>
 <body>
  <div class="container">
   <br />
   <h3 align="center">Importer le fichier csv qui comporte les notes de Pour les elves de</h3>
   <br />
   <form id="upload_csv" method="post" enctype="multipart/form-data">
    <div class="col-md-3">
     <br />
    
    </div>  
                <div class="col-md-4">  
                    <input type="file" name="csv_file" id="csv_file" accept=".csv, .xlsx" style="margin-top:15px;" />
                </div>  
                <div class="col-md-5">  
                    <input type="submit" name="upload" id="upload" value="Previsualiser les notes" style="margin-top:10px;" class="btn btn-info" />
                </div>  
                <div style="clear:both"></div>
   </form>
   <br />
   <br />
   <div id="csv_file_data"></div>
   
  </div>
 </body>
</html>

<script>

$(document).ready(function(){
 $('#upload_csv').on('submit', function(event){
  event.preventDefault();
  $.ajax({
   url:"fetch.php",
   method:"POST",
   data:new FormData(this),
   dataType:'json',
   contentType:false,
   cache:false,
   processData:false,
   success:function(data)
   {
    var html = '<table class="table table-striped table-bordered">';
    if(data.column)
    {
     html += '<tr>';
     for(var count = 0; count < data.column.length; count++)
     {
      html += '<th>'+data.column[count]+'</th>';
     }
     html += '</tr>';
    }

    if(data.row_data)
    {
     for(var count = 0; count < data.row_data.length; count++)
     {
      html += '<tr>';
      
      html += '<td class="student_id" contenteditable>'+data.row_data[count].identifiants+'</td></tr>';
      html += '<td class="student_name" contenteditable>'+data.row_data[count].Nom_Prenom+'</td>';
      html += '<td class="student_notes" contenteditable>'+data.row_data[count].Notes+'</td>';
     }
    }
    html += '<table>';
    html += '<div class="container" align="center"><button type="button" id="import_data" class="btn btn-success">Envoyer vers la base de données</button></div>';

    $('#csv_file_data').html(html);
    $('#upload_csv')[0].reset();
   }
  })
 });

 $(document).on('click', '#import_data', function(){
  var Nom_Prenom = [];
  var identifiants = [];
  var Notes = [];
  $('.student_name').each(function(){
   Nom_Prenom.push($(this).text());
  });
  $('.student_id').each(function(){
   identifiants.push($(this).text());
  });
  $('.student_notes').each(function(){
   Notes.push($(this).text());
  });
  $.ajax({
   url:"import.php",
   method:"POST",
   data:{Nom_Prenom:Nom_Prenom, identifiants:identifiants, Notes:Notes},
   
   success:function(data)
   {
    $('#csv_file_data').html('<div class="alert alert-success">Data Imported Successfully</div>');
   }
  })
 });
});

</script>
