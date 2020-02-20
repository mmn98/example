<?php
include_once 'common.class.php';
class Users extends Common
{
    public function __construct()
    {
        parent::__construct();
    }

    public function add($data)
    {
        $result = $this->db->insert('usres', $data);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function get_all()
    {
        $this->db->where("admin", 0);
        $users = $this->db->get('usres');
        return $users;
    }

    public function deleterecord($id)
    {
        $this->db->where('id', $id);
        $result = $this->db->delete('usres');
        return $result;
    }

    public function edit($id, $data)
    {
        $this->db->where('id', $id);
        $result = $this->db->update('usres', $data);
        return $result;
    }

    public function showdata($id)
    {
        $this->db->where("id", $id);
        $result = $this->db->getOne("usres");
        return $result;
    }

    public function multi_delete($ids)
    {
        $this->db->where("id", $ids, 'IN');
        $result = $this->db->delete('usres');
        return $result;
    }
}
?>

