
      <script>
          function colores(){
              var color = document.getElementById("estado");
              var estado = document.getElementById("estado").value;
              if(estado=="Bueno"){
                  color.className = "Bueno";
              }
              if(estado=="Malo"){
                  color.className = "Malo";
              }
              if(estado=="Mantenimiento correctivo"){
                  color.className = "Mantenimiento correctivo";
              }
              if(estado=="Mantenimiento Preventivo"){
                color.className = "Mantenimiento Preventivo";
            }
          }
      </script>
 
  <body>
      
              <option value="">Elegir Estado</option>
              <option value="Aceptado">Aceptado</option>
              <option value="Proceso">Proceso</option>
              <option value="Cerrado">Cerrado</option>
          </select>
          <input type="submit" value="Enviar">
      </form>
  </body>
  </html>
  


  $(window).on("load resize ", function() {
    var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
    $('.tbl-header').css({'padding-right':scrollWidth});
  }).resize();