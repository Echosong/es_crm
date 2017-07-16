<?php
class DB extends Model {

    static public $_garr = array('limit' => 0, 'where' => '1=1', 'field' => '*', 'orderby' => '');

    /**
     * 查询条件
     * @param  [type] $where [条件字符串]
     * @return [type]           [description]
     */
    public function where($where = '') {
        self::$_garr['where'] = $where;
        return $this;
    }

    /**
     * 查询字段
     * @param  [type] $field [条件字符串]
     * @return [type]           [description]
     */
    public function fields($field = "*") {
        self::$_garr['field'] = $field;
        return $this;
    }

    /**
     * 查询前多少条
     * @param  [type] $top [条件字符串]
     * @return [type]           [description]
     */
    public function take($top) {
        self::$_garr['limit'] = $top;
        return $this;
    }

    /**
     * 排序
     * @param  [type] $top [条件字符串]
     */
    public function orderDesc($field) {
        if (trim(self::$_garr['orderby']) == '') {
            self::$_garr['orderby'] .= $field . ' DESC';
        } else {
            self::$_garr['orderby'] .= ' , ' . $field . ' DESC';
        }

        return $this;
    }

    /**
     * 正序
     * @param  [type] $top [条件字符串]
     */
    public function order($field) {
        if (trim(self::$_garr['orderby']) == '') {
            self::$_garr['orderby'] .= $field . ' ASC';
        } else {
            self::$_garr['orderby'] .= ', ' . $field . ' ASC';
        }
        return $this;
    }

    /**
     * 分页获取数
     * @param  [type] $currpage [当前页码]
     * @return [type]           [description]
     */
    public function get($limit = null) {
        if ($limit == null) {
            $limit = self::$_garr['limit'];
        }
        if ($limit == null) {
            return $this -> findAll(self::$_garr['where'], self::$_garr['orderby'], self::$_garr['field']);
        } else {
            return $this -> findAll(self::$_garr['where'], self::$_garr['orderby'], self::$_garr['field'], $limit);
        }
    }

    /**
     * 获取数量
     * @param  [type] $currpage [当前页码]
     * @return [type]           [description]
     */
    public function count() {
        return $this -> findCount(self::$_garr['where']);
    }

    /**
     * 默认查询首条
     * @param  [type] $currpage [当前页码]
     * @return [type]           [description]
     */
    public function firstOrFail($id = 0) {
        if ($id == 0) {
            return null;
        } else {
            return $this -> find(array('id' => $id));
        }
    }

    /**
     * 添加或者修改数据
     */
    public function addOrEdit($post) {
        $id = $post['id'];
        unset($post['id']);
        if ($id) {
            $this -> update(array('id' => $id), $post);
        } else {
            $this -> create($post);
        }
        return true;
    }

}
?>
