<?

/**
 * Class Controles.
 * Clase base para todos los controles Web html. 
 * Fecha Creacion: 12/11/2011
 * Fecha Modificacion: 03/05/2014
 * Agregado TH a table.
 * Nuevo Control Formulario (Form), nuevo control hidden
 * @author Emiliano Noli <noliemiliano@gmail.com>
 * @package GTE_ControlesWeb
 */
class Controles {

    protected $id;
    protected $name;
    protected $value;
    protected $clase;
    protected $width;
    protected $heigth;
    protected $onclick;
    protected $onchange;
    protected $onmouseup;
    protected $onmousedown;
    protected $onmousemove;
    protected $onmouseover;
    protected $onmouseout;
    protected $disabled;
    protected $style;
    protected $title;
    protected $Html = "";
    protected $InnerText;

    /**
     * Si $v=false Setea valor, sino obtiene valor.
     * @param int $v Setea el id del control.
     * @return string Devuelve el id del control.
     */
    public function id($v = false) {
        if (!$v)
            return $this->id;
        else
            $this->id = $v;
    }

    /**
     * Si $v=false Setea valor, sino obtiene valor.
     * @param int $v Setea el tipo del control.
     * @return string Devuelve el tipo del control.
     */
    public function tipo($v = false) {
        if (!$v)
            return $this->tipo;
        else
            $this->tipo = $v;
    }

    /**
     * Si $v=false Setea valor, sino obtiene valor.
     * @param int $v Setea el name del control.
     * @return string Devuelve el name del control.
     */
    public function name($v = false) {
        if (!$v)
            return $this->name;
        else
            $this->name = $v;
    }

    /**
     * Si $v=false Setea valor, sino obtiene valor.
     * @param int $v Setea la clase del control.
     * @return string Devuelve la clase del control.
     */
    public function clase($v = false) {
        if (!$v)
            return $this->clase;
        else
            $this->clase = $v;
    }

    /**
     * Si $v=false Setea valor, sino obtiene valor.
     * @param int $v Setea el width del control.
     * @return string Devuelve el width del control.
     */
    public function width($v = false) {
        if (!$v)
            return $this->width;
        else
            $this->width = $v;
    }

    /**
     * Si $v=false Setea valor, sino obtiene valor.
     * @param int $v Setea el heigth del control.
     * @return string Devuelve el heigth del control.
     */
    public function heigth($v = false) {
        if (!$v)
            return $this->heigth;
        else
            $this->heigth = $v;
    }

    /**
     * Si $v=false Setea valor, sino obtiene valor.
     * @param int $v Setea el onclick del control.
     * @return string Devuelve el onclick del control.
     */
    public function onclick($v = false) {
        if (!$v)
            return $this->onclick;
        else
            $this->onclick = $v;
    }

    /**
     * Si $v=false Setea valor, sino obtiene valor.
     * @param int $v Setea el onchange del control.
     * @return string Devuelve el onchange del control.
     */
    public function onchange($v = false) {
        if (!$v)
            return $this->onchange;
        else
            $this->onchange = $v;
    }

    /**
     * Si $v=false Setea valor, sino obtiene valor.
     * @param int $v Setea el onmousedown del control.
     * @return string Devuelve el onmousedown del control.
     */
    public function onmousedown($v = false) {
        if (!$v)
            return $this->onmousedown;
        else
            $this->onmousedown = $v;
    }

    /**
     * Si $v=false Setea valor, sino obtiene valor.
     * @param int $v Setea el onmouseup del control.
     * @return string Devuelve el onmouseup del control.
     */
    public function onmouseup($v = false) {
        if (!$v)
            return $this->onmouseup;
        else
            $this->onmouseup = $v;
    }

    /**
     * Si $v=false Setea valor, sino obtiene valor.
     * @param int $v Setea el onmousemove del control.
     * @return string Devuelve el onmousemove del control.
     */
    public function onmousemove($v = false) {
        if (!$v)
            return $this->onmousemove;
        else
            $this->onmousemove = $v;
    }

    /**
     * Si $v=false Setea valor, sino obtiene valor.
     * @param int $v Setea el onmouseover del control.
     * @return string Devuelve el onmouseover del control.
     */
    public function onmouseover($v = false) {
        if (!$v)
            return $this->onmouseover;
        else
            $this->onmouseover = $v;
    }

    /**
     * Si $v=false Setea valor, sino obtiene valor.
     * @param int $v Setea el onmouseout del control.
     * @return string Devuelve el onmouseout del control.
     */
    public function onmouseout($v = false) {
        if (!$v)
            return $this->onmouseout;
        else
            $this->onmouseout = $v;
    }

    /**
     * Habilita o deshabilita el control.
     * @param int $v=false Deshabilita el control.
     * @param int $v=true Habilita el control.
     */
    public function disabled($v = false) {
        if (!$v)
            unset($this->disabled);
        else
            $this->disabled = $v;
    }

    /**
     * Si $v=false Setea valor, sino obtiene valor.
     * @param int $v Setea el style del control.
     * @return string Devuelve el style del control.
     */
    public function style($estilos) {
        if (!$estilos)
            return $this->style;
        else
            $this->style = $estilos;
    }

    /**
     * Si $v=false Setea valor, sino obtiene valor.
     * @param int $v Setea el title del control.
     * @return string Devuelve el title del control.
     */
    public function title($title) {
        if (!$title)
            return $this->title;
        else
            $this->title = $title;
    }

    /**
     * Obtiene o setea el atributo value del boton
     * @param string $v Setea el atributo value.
     * @return  string Retorna el atributo value.
     */
    public function value($v = false) {
        if (!$v)
            return $this->value;
        else
            $this->value = $v;
    }

    /**
     * Devuelve todos los atributos que tiene seteados el control, para imprimirlo en pantalla.
     * Utilizo ' para poder enviar codigo js y que tome las ' (comillas simples) si encierro el 
     * codigo con comilla " se chotea. 
     * @return string Devuelve todos los atributos del control en codigo Html.
     */
    protected function Atributos() {
        $attr = "";

        if (isset($this->type) ? $attr .= ' type="' . $this->type . '" ' : $attr .= ' ')
            ;
        if (isset($this->id) && $this->id ? $attr .= ' id="' . $this->id . '" ' : $attr .= ' ')
            ;
        if (isset($this->name) ? $attr .= ' name="' . $this->name . '" ' : $attr .= ' ')
            ;
        if (isset($this->value) ? $attr .= ' value="' . $this->value . '" ' : $attr .= ' ')
            ;
        if (isset($this->style) ? $attr .= ' style="' . $this->style . '" ' : $attr .= ' ')
            ;
        if (isset($this->title) ? $attr .= ' title="' . $this->title . '" ' : $attr .= ' ')
            ;
        if (isset($this->clase) ? $attr .= ' class="' . $this->clase . '" ' : $attr .= ' ')
            ;
        if (isset($this->width) ? $attr .= ' width="' . $this->width . '" ' : $attr .= ' ')
            ;
        if (isset($this->heigth) ? $attr .= ' heigth="' . $this->heigth . '" ' : $attr .= ' ')
            ;
        if (isset($this->onclick) ? $attr .= ' onclick="' . $this->onclick . '" ' : $attr .= ' ')
            ;
        if (isset($this->onchange) ? $attr .= ' onchange="' . $this->onchange . '" ' : $attr .= ' ')
            ;
        if (isset($this->onmousedown) ? $attr .= ' onmousedown="' . $this->onmousedown . '" ' : $attr .= ' ')
            ;
        if (isset($this->onmouseup) ? $attr .= ' onmouseup="' . $this->onmouseup . '" ' : $attr .= ' ')
            ;
        if (isset($this->onmousemove) ? $attr .= ' onmousemove="' . $this->onmousemove . '" ' : $attr .= ' ')
            ;
        if (isset($this->onmouseover) ? $attr .= ' onmouseover="' . $this->onmouseover . '" ' : $attr .= ' ')
            ;
        if (isset($this->onmouseout) ? $attr .= ' onmouseout="' . $this->onmouseout . '" ' : $attr .= ' ')
            ;
        if (isset($this->disabled) ? $attr .= ' disabled="' . $this->disabled . '" ' : $attr .= ' ')
            ;
        return ($attr);
    }

    /**
     * Imprime el codigo html del objeto en pantalla.
     */
    public function Show() {
        print $this->Html;
    }

    /**
     * Devuleve el codigo html del objeto como string.
     */
    public function getHtml() {
        return $this->Html;
    }

}

/**
 * Class ListBox.
 * Crea un Select Html
 * @author Emiliano Noli <noliemiliano@gmail.com>
 * @package GTE_ControlesWeb
 */
class ListBox extends Controles {

    protected $items = array();
    protected $size = 1;
    private $ItemSelected = false;

    /**
     * Crea un control Select y sus Options si son enviadas.
     * @param string $name Define name y id del control.
     * @param array $items Options del select creado.
     */
    public function __construct($name = null, $items = false) {
        $this->id($name);
        $this->name($name);
        if ($items)
            $this->addItems($items);
    }

    /**
     * 
     * @return Devuelve los Options en un array
     */
    public function getItems() {
        return $this->items;
    }

    /**
     * Elimina todos los Options del control.
     */
    public function removeItems() {
        if (sizeof($this->items) > 0) {
            foreach ($this->items as $k => $v) {
                unset($this->items[$k]);
            }
        }
    }

    /**
     * Elimina el Item seleccionado.
     * @param mixed $item innerText del Option que se quiere eliminar.
     */
    public function removeItem($item) {
        foreach ($this->items as $k => $v) {
            if ($item == $v)
                unset($this->items[$k]);
        }
    }

    /**
     * Agrega mas de un Option al Select.
     * @param array $items Options que quieren ser agregadas.
     */
    public function addItems($items) {
        foreach ($items as $v) {
            $this->items[] = $v;
        }
    }

    /**
     * Agrega un Option al Select.
     * @param string $id Id del Option.
     * @param string $valor InnerText del Option.
     * @param bool $selected Setea como default el Option.
     */
    public function addItem($value, $valor, $title = false, $selected = false) {
        $item = array('id' => $value, 'valor' => $valor, 'title' => $title);
        $this->items[] = $item;
        if ($selected)
            $this->ItemSelected = $item;
    }

    /**
     * Setea u obtiene el Size del Select (Cuantas filas mostrara).
     * @param int $v Cantidad de filas a mostrar.
     * @return int Cantidad de filas que muestra actualmente.
     */
    public function size($v = false) {
        if (!$v)
            return $this->size;
        else
            $this->size = $v;
    }

    /**
     * Setea como seleccionado un option del select.
     * @param mixed $v Valor del item (innerText del option)
     */
    public function Selected($v) {
        foreach ($this->items as $item) {
            if ($item['valor'] == $v)
                $this->ItemSelected = $item;
        }
    }

    /**
     * Setea como seleccionado un option del select.
     * @param mixed $i Index del item (value del option)
     */
    public function SelectedId($v) {
        foreach ($this->items as $item) {
            if ($item['id'] == $v)
                $this->ItemSelected = $item;
        }
    }

    /**
     * Genera el codigo html y lo guarda en la propiedad Html.
     */
    public function Create() {
        $this->Html = "<select size='{$this->size}' " . $this->Atributos() . ">";
        foreach ($this->items as $v) {
            if ($v['valor'] === $this->ItemSelected['valor'] ? $selected = "selected" : $selected = "")
                ;
            if ($v['title'] ? $title = "title='" . $v['title'] . "'" : $title = "")
                ;
            $this->Html .='
                <option value="' . $v['id'] . '"' . $selected . ' ' . $title . '>' . $v['valor'] . '</option>';
        }
        $this->Html .= "</select>";
    }

}

/**
 * Class Boton.
 * Crea un Button Html
 * @author Emiliano Noli <noliemiliano@gmail.com>
 * @package GTE_ControlesWeb
 */
class Boton extends Controles {

    protected $value;
    protected $type;
    protected $img;

    /**
     * Instancia un Control Boton -> Button Html.
     * @param string $name Id y Name del Button.
     * @param string $value Value del Button.
     * @param string $type Tipo de Buttom. (Button, Submit, Reset, etc)
     * @param string $img Imagen de fondo.
     */
    public function __construct($name = null, $value = "", $type = "button", $img = false) {
        $this->name = $name;
        $this->id = $name;
        $this->value = $value;
        $this->type = $type;
        $this->img = $img;
    }

    /**
     * Imprime el boton en pantalla.
     */
    public function Show() {
        print "<input " . $this->Atributos() . " />";
    }

    /**
     * 
     * @return string Retorna el codigo html generado.
     */
    public function getHtml() {
        return "<input " . $this->Atributos() . " />";
    }

    /**
     * Genera el codigo html y lo guarda en la propiedad Html.
     */
    public function Create() {
        $this->Html = "<input " . $this->Atributos() . " />";
    }

}

// FIN CLASS Boton

/**
 * Class Div.
 * Crea un Div Html
 * @author Emiliano Noli <noliemiliano@gmail.com>
 * @package GTE_ControlesWeb
 */
class Div extends Controles {
    //protected $InnerText;

    /**
     * Instancia un objeto Div.
     * @param string $name Id y name del Div.
     */
    public function __construct($name = null) {
        //$this->name = $name;
        $this->id = $name;
    }

    /**
     * Agrega contenido al div.
     * @param string $text Puede ser texto plano, o controles web ( control->getHtml() ).
     */
    public function Add($text) {
        $this->InnerText .= $text;
    }

    /**
     * Elimina todo el contenido del div
     */
    public function Delete() {
        $this->InnerText = "";
    }

    /**
     * Imprime el div en pantalla.
     */
    public function Show() {
        print "<div " . $this->Atributos() . ">" . $this->InnerText . "</div>";
    }

    /**
     * @return string Retorna el codigo html generado.
     */
    public function getHtml() {
        return "<div " . $this->Atributos() . ">" . $this->InnerText . "</div>";
    }

    /**
     * Genera el codigo html y lo guarda en la propiedad Html.
     */
    public function Create() {
        $this->Html = "<div " . $this->Atributos() . ">" . $this->InnerText . "</div>";
    }

}

/**
 * Class TextBox.
 * Crea un Input Type="text" Html
 * @author Emiliano Noli <noliemiliano@gmail.com>
 * @package GTE_ControlesWeb
 */
class TextBox extends Controles {

    /**
     * Instancia un objeto TextBox.
     * @param string $id Opcional - Id del input text.
     */
    public function __construct($id = null, $value = null) {
        $this->id = $id;
        $this->name = $id;
        $this->value = $value;
    }

    /**
     * Genera el codigo html y lo guarda en la propiedad Html.
     */
    public function Create() {
        $this->Html = "<input type='text' " . $this->Atributos() . "/>";
    }

}

/**
 * Class Image.
 * Crea un tag img Html
 * @author Emiliano Noli <noliemiliano@gmail.com>
 * @package GTE_ControlesWeb
 */
class Image extends Controles {

    private $src, $alt;

    /**
     * Instancia un objeto Image.
     * @param string $id Opcional - Id del input text y name por default.
     */
    public function __construct($src, $alt = null, $id = null) {
        $this->src = "src='{$src}'";
        $this->id = $id;
        $this->name = $id;
        $this->alt = $alt;
    }

    /**
     * Genera el codigo html y lo guarda en la propiedad Html.
     */
    public function Create() {
        if (!is_null($this->alt))
            $this->alt = "alt='{$this->alt}'";

        $this->Html = "<img {$this->src} " . $this->Atributos() . " {$this->alt}/>";
    }

}

/**
 * Class Link.
 * Crea un tag a Html
 * @author Emiliano Noli <noliemiliano@gmail.com>
 * @package GTE_ControlesWeb
 */
class Link extends Controles {

    private $href, $rel;

    /**
     * Instancia un objeto Link.
     * @param string $id Opcional - Id del input text y name por default.
     */
    public function __construct($href, $id = null, $rel = null) {
        $this->href = "href='{$href}'";
        $this->id = $id;
        $this->name = $id;
        $this->rel = $rel;
    }

    /**
     * Genera el codigo html y lo guarda en la propiedad Html.
     */
    public function Create() {
        $rel = "";
        if (!is_null($this->rel))
            $rel = "rel='{$this->rel}'";

        $this->Html = "<a {$this->href} " . $this->Atributos() . " {$rel} >{$this->InnerText}</a>";
    }

}

/**
 * Class FileUpload.
 * Crea un Selector de archivos Html.
 * @author Emiliano Noli <noliemiliano@gmail.com>
 * @package GTE_ControlesWeb
 */
class FileUpload extends Controles {

    private $action, $iWidth, $iHeight, $caption = false, $Full_Type = false;

    /**
     * Instancia un objeto FileUpload.
     * @param string $id Opcional - Id del input text.
     */
    public function __construct($name) {
        $this->id = $name;
        $this->name = $name;
        $this->iWidth = 79;
        $this->iHeight = 20;
    }

    /**
     * Setea el tipo de FileUpload. 
     * True crea un FileUpload Basico para utilizar dentro de un formulario externo.
     * False crea un FileUpload Compuesto por un Formulario, un i-freme al cual se hara el post y un submit.
     * @param bool $v
     */
    public function Full_Type() {
        $this->Full_Type = true;
    }

    /**
     * Define el action del formulario.
     * @param string $form Script Php que recibe y procesa el archivo.
     */
    public function action($script) {
        $this->action = $script;
    }

    /**
     * Titulo de la tabla que contiene el formulario y el input file
     * @param string $text Titulo
     */
    public function caption($text) {
        $this->caption = $text;
    }

    public function Create_Basic() {

        $InputFile = "<div style='' class='custom-input-file'>"
                . "<input type='text' disabled='disabled' style='margin-bottom:2px;' id='FU_txt_" . $this->name . "' name='FU_txt_" . $this->name . "' value=''/>"
                . "<input style='display:none' type='file' id='" . $this->name . "' name='" . $this->name
                . "' class='input-file' onchange=\"document.getElementById('FU_txt_" . $this->name . "').value=this.value \" />"
                . "<br/><input name='FU_btn_" . $this->name . "'  type='button' "
                . "onclick=\"document.getElementById('" . $this->name . "').click()\" value='Examinar'>"
                . "</div>";
        $Table = new Table("Table_" . $this->id);
        $Table->caption($this->caption);
        $data = array($InputFile);
        $Table->setRowData($data);
        $Table->Create();
        $this->Html .= $Table->getHtml();
    }

    public function Create_Full() {
        $InputFile = "<div style='' class='custom-input-file'>"
                . "<input type='text' disabled='disabled' style='margin-bottom:2px;' name='span_" . $this->name . "' value=''/>"
                . "<input style='display:none' type='file' name='input_" . $this->name . "' class='input-file' onchange='frm_" . $this->name . ".span_" . $this->name . ".value=this.value' />"
                . "<br/><input name='button_" . $this->name . "'  type='button' onclick='frm_" . $this->name . ".input_" . $this->name . ".click()' value='Examinar'>"
                . "</div>";
        $Table = new Table("Table_" . $this->id);
        $Table->caption($this->caption);
        $data = array($InputFile);
        $Table->setRowData($data);
        $iframe = '<iframe style="display:none" name="iframe_' . $this->name . '" width="' . $this->iWidth . '" height="' . $this->iHeight . '"></iframe>';
        $data = array("<input type='submit' onclick='if(frm_{$this->name}.span_{$this->name}.value == \"\") &#123;alert(\"No hay archivo seleccionado\");return (false);&#125; ' value='{$this->value}'>" . $iframe);
        $Table->setRowData($data);
        $Table->Create();
        $this->Html = '<form method="post" name="frm_' . $this->name . '" enctype="multipart/form-data" action="' . $this->action . '" target="iframe_' . $this->name . '">';
        $this->Html .= $Table->getHtml();
        $this->Html .= '</form>';
    }

    /**
     * Genera el codigo html y lo guarda en la propiedad Html.
     */
    public function Create() {
        if ($this->Full_Type) {
            $this->Create_Full();
        } else {
            $this->Create_Basic();
        }
    }

}

/**
 * Class Table.
 * Crea una tabla Html.
 * @author Emiliano Noli <noliemiliano@gmail.com>
 * @package GTE_ControlesWeb
 */
class Table extends Controles {

    private $header = array(), $row_count, $border, $rows = array(), $caption = false;

    /**
     * Constructor de la clase.
     * @param mixed $id Id de la tabla (Div Contenedor).
     * @param int $Rows Cantidad de filas.
     * @param mixed $height Alto de la tabla. Atributos CSS. Ej. 450px ó 100%.
     * @param mixed $height Ancho de la tabla. Atributos CSS. Ej. 450px ó 100%.
     */
    public function __construct($id, $height = false, $width = false) {
        $this->id = $id;
        $this->heigth = $height;
        $this->width = $width;
    }

    /**
     * Suma un th al header.
     * @param string $th
     */
    public function add_th($th) {
        array_push($this->header, $th);
    }
    /**
     * Titulo de la tabla.
     * @param string $text Titulo
     */
    public function caption($text) {
        $this->caption = $text;
    }

    /**
     * Acepta un array de datos, para formar una tabla sin acceder a los atributos de sus celdas td.
     * @param int $row Fila a la cual se asignaran los datos.
     * @param array $datos Datos que se insertaran en la fila. Deben ser un array de string o int.
     */
    public function setRowData($datos, $row = null) {
        $row = new table_row();
        $row_id = $this->row_count + 0;
        foreach ($datos as $key => $value) {
            $id = $this->id . "_" . $row_id . "_" . $key;
            $cell = new table_cell($value, $id);
            $row->add_cell($cell);
        }
        $this->add_row($row);
    }

    /**
     * Agrega una fila a la tabla. Es un objeto table_row
     * @param table_row $tr 
     */
    public function add_row($tr) {
        $this->row_count +=1;
        array_push($this->rows, $tr);
    }

    /**
     * Setea el ancho del borde de la tabla.
     * @param int $v
     */
    public function border($v) {
        $this->border = "border='{$v}'";
    }

    /**
     * Genera el codigo html con los parametros configurados y lo guarda en la propiedad Html como String.
     */
    public function Create() {
        $this->Html = "<table {$this->border} {$this->Atributos()} id='{$this->id}' {$this->style} >";
        if ($this->caption)
            $this->Html .= "<caption>{$this->caption}</caption>";
        foreach ($this->header as $th) {
            $this->Html .= "<th>$th</th>";
        }
        foreach ($this->rows as $row) {

            $row->Create();
            $this->Html .= $row->getHtml();
        }
        $this->Html .= "</table>";
    }

}

/**
 * Representa un tag <tr></tr> de una tabla.
 * Contiene objetos table_cell
 * @author Emiliano Noli <noliemiliano@gmail.com>
 * @package GTE_ControlesWeb
 */
class table_row extends Controles {

    /**
     * Cantidad de celdas que contiene la fila
     * @var int $cell_count 
     */
    private $cell_count;
    private $cells = array();

    /**
     * Retorna la cantidad de celdas que contiene la fila.
     * @return int
     */
    public function count() {
        return $this->cell_count;
    }

    /**
     * Suma un td (table_cell) a la fila.
     * @param table_cell $cell Objeto table_cell
     */
    public function add_cell($cell) {
        $this->cell_count += 1;
        array_push($this->cells, $cell);
    }

    public function Create() {
        if (isset($this->style) ? $style = "style='{$this->style}'" : $style = "")
            ;
        $this->Html = "<tr {$this->Atributos()} $style>";
        foreach ($this->cells as $cell) {
            $cell->Create();
            $this->Html .= $cell->getHtml();
        }
        $this->Html .="</tr>";
    }

}

/**
 * Representa un tag <td></td> de una tabla.
 * @author Emiliano Noli <noliemiliano@gmail.com>
 * @package GTE_ControlesWeb
 */
class table_cell extends Controles {

    private $rowspan, $colspan;

    public function __construct($text, $id = false, $rs = false, $cs = false) {
        $this->InnerText = $text;
        $this->id = $id;
        $this->rowspan = $rs;
        $this->colspan = $cs;
    }

    public function Create() {
        if ($this->rowspan ? $rs = " rowspan='" . $this->rowspan . "'" : $rs = '')
            ;
        if ($this->colspan ? $cs = " colspan='" . $this->colspan . "'" : $cs = '')
            ;

        $this->Html = "<td {$rs}{$cs}{$this->Atributos()}>{$this->InnerText}</td>";
    }

}

/**
 * Class TableView.
 * Crea una tabla a partir de Divs y Maquetacion Css.
 * @author Emiliano Noli <noliemiliano@gmail.com>
 * @package GTE_ControlesWeb
 */
class TableView extends Controles {

    private $Header, $RowHeight = "";

    /**
     * Array de divs que representan las celdas de la tabla.
     * @var array 
     * @access private
     */
    private $RowsData = array();

    /**
     * Constructor de la clase.
     * @param mixed $id Id de la tabla (Div Contenedor).
     * @param int $Rows Cantidad de filas.
     * @param mixed $height Alto de la tabla. Atributos CSS. Ej. 450px ó 100%.
     * @param mixed $height Ancho de la tabla. Atributos CSS. Ej. 450px ó 100%.
     */
    public function __construct($id, $height = false, $width = false) {
        $this->id = $id;
        $this->heigth = $height;
        $this->width = $width;
    }

    /**
     * Asigna a la fila indicada los datos del array.
     * Cada Celda es representada por un div, cuyo Id html sera formado por IdTabla_NroFila_NroCelda. 
     * Ej. Tabla1_1_2. Representa la celda 3 (enumeracion 0,1,2,3 etc.) 
     * de la fila 1 (numeracion dada por el usuario al llamar a la funcion) de la tabla Tabla1.
     * @param int $row Fila a la cual se asignaran los datos.
     * @param array $datos Datos que se insertaran en la fila. Deben ser un array de string o int.
     */
    public function setRowData($datos, $row = null) {
        $data = "";
        if (!$row) {
            $row = count($this->RowsData);
        }

        foreach ($datos as $key => $value) {
            $div = new Div();
            $div->id = $this->id . "_" . $row . "_" . $key;
            $div->clase("C_" . $key);
            $div->Add($value);
            //$width = 100 / count($datos);
            $estilos = "display:table-cell;{$this->RowHeight}";
            $div->style($estilos);
            $div->Create();
            $data .= $div->getHtml();
        }
        $this->RowsData[$row] = $data;
    }

    /**
     * Obtiene o setea el minHeight en px de las fila
     * @param int $v Alto de cada fila en px.
     * @return int Alto de cada fila en px. 
     */
    public function RowHeight($v) {
        if (!$v)
            return $this->RowHeight;
        else
            $this->RowHeight = "height:{$v}px;";
    }

    /**
     * Genera el codigo html con los parametros configurados y lo guarda en la propiedad Html como String.
     */
    public function Create() {
        ksort($this->RowsData);
        $contenedor = new Div($this->id);
        $contenedor->clase("TableView");
        $estilos = "display:table;" . $this->style;
        if ($this->heigth)
            $estilos .= "height:{$this->heigth};";
        if ($this->width)
            $estilos .= "width:{$this->width}";
        $contenedor->style($estilos);
        foreach ($this->RowsData as $row => $value) {
            $div = new Div("R_" . $row);
            $div->Add($value);
            $div->clase("TableViewRow");
            $div->style("display:table-row;{$this->RowHeight}");
            $contenedor->Add($div->getHtml());
        }
        $this->Html = $contenedor->getHtml();
    }
}
/**
 * Formulario HTML
 * 
 */
    class form extends Controles {
        public $method,$action,$controles = array(),$encrypt;
        
        function __construct($m,$a,$id = "formulario"){
            $this->method = $m;
            $this->action = $a;
            $this->id = $id;
            $this->name = $id;
        }

        function addControl($control){
            array_push($this->controles, $control);
        }
        function create(){
            $this->Html = "<form action='$this->action' method='$this->method'{$this->Atributos()}>";
                    foreach($this->controles as $control){
                        $control->Create();
                        $this->Html .= $control->getHtml();
                    }
            $this->Html .= "</form>";
        }
    }    
 /**
 * Class Hidden.
 * Crea un Input Type="hidden" Html
 * @author Emiliano Noli <noliemiliano@gmail.com>
 * @package GTE_ControlesWeb
 */
class hidden extends Controles {

    /**
     * Instancia un objeto TextBox.
     * @param string $id Opcional - Id del input text.
     */
    public function __construct($id = null, $value = null) {
        $this->id = $id;
        $this->name = $id;
        $this->value = $value;
    }
    /**
     * Genera el codigo html y lo guarda en la propiedad Html.
     */
    public function Create() {
        $this->Html = "<input type='hidden' " . $this->Atributos() . "/>";
    }

}

?>