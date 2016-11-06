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
                        <input type=\"checkbox\" name=Categorias[] value=\"$row->id\">$row->nombre
                        </li>";
            }    
        }
        else
        {
            echo "E<.";
        }
    }   
    function get_Categorias_nav()
    {
        require "./config/db.php";
        $resultado = $mysqli->query("SELECT * FROM categoria");
        if($resultado->num_rows > 0)
        {
            while ($row = mysqli_fetch_object($resultado))
            {
                 echo " <li>
                        <a href=\"\">$row->nombre</a>
                        </li>";
            }    
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
    				  <a href=><img src=\"./get_img_producto.php?id=$row->id\" alt=\"...\"></a>
    				  <div class=\"carousel-caption\">
    					<h3>$row->nombre<h3>
    				  </div>
    				</div>";
                }
                else
                {
                    echo "<div class=\"item\">
    				  <img src=\"./get_img_producto.php?id=$row->id\"alt=\"...\">
    				  <div class=\"carousel-caption\">
    					<h3>$row->nombre<h3>
    				  </div>
    				</div>";
                }
                $contador += 1;
    				
            }    
        }
    }
?>