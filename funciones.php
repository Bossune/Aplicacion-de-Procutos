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
?>