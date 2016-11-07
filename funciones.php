<?php
    function get_Categorias()
    {
        require "./config/db.php";
        $resultado = $mysqli->query("SELECT * FROM categoria");
        if($resultado->num_rows > 0)
        {
            while ($row = mysqli_fetch_object($resultado))
            {
                 echo " <li>
                        <input type=\"checkbox\" name=Categorias[] value=\"$row->id\">$row->nombre_categoria
                        </li>";
            }    
        }
       
    }   
    function get_Categorias_nav()
    {
        require "./config/db.php";
        $resultado = $mysqli->query("SELECT * FROM categoria");
        if($resultado->num_rows > 0)
        {
            echo "<ul class='dropdown-menu' name='cat'>";
            while ($row = mysqli_fetch_object($resultado))
            {
                 echo " <li>
                        <a href=\"./Busqueda.php?categorias=$row->id\">$row->nombre_categoria</a>
                        </li>";
            }
            echo "</ul>";
        }
        else
        {
            echo "E<.";
        }
    }

    function get_cProductos()
    {
        $contador = 1;
        require "./config/db.php";
        $resultado = $mysqli->query("SELECT * FROM producto ORDER BY fecha_actualizacion DESC LIMIT 4");
        if($resultado->num_rows > 0)
        {
            while ($row = mysqli_fetch_object($resultado))
            {
                if ($contador == 1)
                {
                 echo "<div class=\"item active\">
    				 <a class=\"img-responsive\"  href=\"./producto.php?id=$row->id\"> <img src=\"./get_img_producto.php?id=$row->id\" alt=\"...\"></a>
    				  <div class=\"carousel-caption\">
    					<h3>$row->nombre<h3>
    				  </div>
    				</div>";
                }
                else
                {
                    echo "<div class=\"item\">
    				  <a href=\"./producto.php?id=$row->id\"><img src=\"./get_img_producto.php?id=$row->id\" alt=\"...\"></a>

    				  <div class=\"carousel-caption\">
    					<h3>$row->nombre<h3>
    				  </div>
    				</div>";
                }
                $contador += 1;
    				
            }    
        }
    }
    
    function get_Regiones()
    {
        	require './config/db.php';
			$cons1= "select id,nombre_region from region";
			$resp1 = $mysqli->query($cons1);
			
			echo "<label>Buscar por Region</label><br>";
			echo "<select style=\"max-width:90%;\" id='SelectReg' name='region' >";
			echo "<option selected value=\"0\">...</option>";
            echo "<optgroup>";

			while ($fila1 = $resp1->fetch_array(MYSQLI_BOTH)) {
				echo "<option value=".$fila1['id'].">".$fila1['nombre_region']."</option>";
			}
            echo "</optgroup>";
			echo "</select>";
        
    }
?>