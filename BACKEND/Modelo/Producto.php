<?php
include 'Conexion.php';

class Producto
{
    private $Id_Pro;
    private $Pro_ProductoRef;
    private $Pro_Nombre;
    private $Pro_Stock;
    private $Pro_Precio;
    private $Pro_Marca;
    private $Proveedores_Id_Prov;
    private $Categoria_Id_Cat;
    private $Id_EstadoP;
    private $Conexion;

    public function __construct($Id_Pro = null, $Pro_ProductoRef = null, $Pro_Nombre = null, $Pro_Stock = null, $Pro_Precio = null, $Pro_Marca = null, $Proveedores_Id_Prov = null, $Categoria_Id_Cat = null, $Id_EstadoP = null)
    {
        $this->Id_Pro = $Id_Pro;
        $this->Pro_ProductoRef = $Pro_ProductoRef;
        $this->Pro_Nombre = $Pro_Nombre;
        $this->Pro_Stock = $Pro_Stock;
        $this->Pro_Precio = $Pro_Precio;
        $this->Pro_Marca = $Pro_Marca;
        $this->Proveedores_Id_Prov = $Proveedores_Id_Prov;
        $this->Categoria_Id_Cat = $Categoria_Id_Cat;
        $this->Id_EstadoP = $Id_EstadoP;
        $this->Conexion = Conectarse();
    }

    public function agregarProducto($Pro_ProductoRef, $Pro_Nombre, $Pro_Stock, $Pro_Precio, $Pro_Marca, $Proveedores_Id_Prov, $Categoria_Id_Cat, $Id_EstadoP)
    {
        $this->Conexion = Conectarse();
    
        $sql = "INSERT INTO productos (Pro_ProductoRef, Pro_Nombre, Pro_Stock, Pro_Precio, Pro_Marca, Proveedores_Id_Prov, Categoria_Id_Cat, Id_EstadoP)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param("ssiisiii", $Pro_ProductoRef, $Pro_Nombre, $Pro_Stock, $Pro_Precio, $Pro_Marca, $Proveedores_Id_Prov, $Categoria_Id_Cat, $Id_EstadoP);
        $stmt->execute();
        $stmt->close();
        $this->Conexion->close();
    }

    public function consultarProducto($Id_Pro)
    {
        $this->Conexion = Conectarse();

        $sql = "SELECT * FROM productos WHERE Id_Pro = ?";
        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param("i", $Id_Pro);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();
        $this->Conexion->close();
        return $resultado;   
    }

    public function consultarProductos()
    {
        $this->Conexion = Conectarse();

        // Consulta JOIN para obtener información adicional
        $sql = "SELECT p.Id_Pro, p.Pro_ProductoRef, p.Pro_Nombre, p.Pro_Stock, p.Pro_Precio, p.Pro_Marca, 
                       pr.Prov_Nombre, c.Cat_Nombre, e.Estp_Descripcion
                FROM productos p
                JOIN proveedores pr ON p.Proveedores_Id_Prov = pr.Id_Prov
                JOIN categoria c ON p.Categoria_Id_Cat = c.Id_Cat
                JOIN estado_producto e ON p.Id_EstadoP = e.Id_EstadoP ORDER BY `p`.`Id_Pro` ASC";
                
        $resultado = $this->Conexion->query($sql);
        $this->Conexion->close();
        return $resultado;  
    }

    public function actualizarProducto($Id_Pro, $Pro_ProductoRef, $Pro_Nombre, $Pro_Stock, $Pro_Precio, $Pro_Marca, $Proveedores_Id_Prov, $Categoria_Id_Cat, $Id_EstadoP)
    {
        $this->Conexion = Conectarse();
     
        // Consulta SQL corregida (incluye la Marca)
        $sql = "UPDATE productos 
                SET Pro_ProductoRef=?, Pro_Nombre=?, Pro_Stock=?, Pro_Precio=?, Pro_Marca=?, Proveedores_Id_Prov=?, Categoria_Id_Cat=?, Id_EstadoP=? 
                WHERE Id_Pro=?";
        
        // Bind de parámetros corregido
        // Se cambia "ssiisiiii" -> "ssidsiiii" (marca debe ser string, precio double)
        $stmt = $this->Conexion->prepare($sql);
        $stmt->bind_param("ssidsiiii", $Pro_ProductoRef, $Pro_Nombre, $Pro_Stock, $Pro_Precio, $Pro_Marca, $Proveedores_Id_Prov, $Categoria_Id_Cat, $Id_EstadoP, $Id_Pro);
    
        $resultado = $stmt->execute();
    
        $stmt->close();
        $this->Conexion->close();
    
        return $resultado;
    }


    public function obtenerProveedores()
    {
        $this->Conexion = Conectarse();
        $sql = "SELECT Id_Prov, Prov_Nombre FROM proveedores";
        $resultado = $this->Conexion->query($sql);
        $this->Conexion->close();
        return $resultado;
    }

    public function obtenerCategorias()
    {
        $this->Conexion = Conectarse();
        $sql = "SELECT Id_Cat, Cat_Nombre FROM categoria";
        $resultado = $this->Conexion->query($sql);
        $this->Conexion->close();
        return $resultado;
    }

    public function obtenerEstadosProducto()
    {
        $this->Conexion = Conectarse();
        $sql = "SELECT Id_EstadoP, Estp_Descripcion FROM estado_producto";
        $resultado = $this->Conexion->query($sql);
        $this->Conexion->close();
        return $resultado;
    }
}
?>
