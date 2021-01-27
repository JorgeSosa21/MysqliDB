<?php 
	class QueryDB{
		private $query, $parametros, $formato, $mysqli, $result;
		const HOST_NAME = 'localhost';
		const USER_NAME = 'root';
		const PASSWORD = '';
		const DATABASE = 'test';
		
		private $uselessVariable;
		
		public function __construct($query, $formato, $parametros){
			$this->query = $query;
			$this->parametros = $parametros;
			$this->formato = $formato;
		}
		
		public function ejecutar(){
			$this->conectar();
			$this->result = $this->mysqli->prepare($this->query);
			
			if (!$this->result){
				return("Error de sintaxis en query: ".$this->query);
			}
			
			if ($this->formato !== 0)
				$this->bindParam();
			
			$tabla = $this->resultado();
			$this->desconectar();
			return $tabla;
		}
		
		protected function conectar(){
			$this->mysqli = @new mysqli(self::HOST_NAME, self::USER_NAME, self::PASSWORD, self::DATABASE);
			
			if($this->mysqli->connect_error){
				die("Error al conectarse con la base de datos: ".$this->mysqli->connect_error);
			}
		}
		
		protected function desconectar(){
			$this->mysqli->close();
			$this->result->close();
		}
		
		private function bindParam(){
			$parametros = array();
			
			foreach($this->parametros as $key => $value)
				$parametros[$key] = &$this->parametros[$key];
			
			$parametros = array_merge(array($this->formato), $parametros);
			@call_user_func_array(array($this->result, 'bind_param'), $parametros);
		}
		
		private function resultado(){
			$this->mysqli->set_charset("utf8");
			$res = $this->result->execute();

			if ($this->result->error){
				return ("Error al ejecutar la query: ".$this->result->error, E_USER_ERROR);
			}
				
			$result = $this->result->get_result();
			$tabla = array();
			
			if ($result)
				while ($row = $result->fetch_assoc()) 
					array_push($tabla, $row);
			
			
			if (EMPTY($tabla))
				return $res;
			else
				return $tabla;
		}
		
	}
	
