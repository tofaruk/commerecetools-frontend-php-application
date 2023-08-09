<?php

namespace App\Model;

use App\Config\Database;
use App\Core\BaseModel;

class PostModel extends BaseModel
{
    // TODO delete
    protected $table = 'post';

    /**
     * @param array $data
     * @return bool|void
     */
    public function add($data=[])
    {
        try {
            $statement = $this->db->prepare('INSERT INTO ' . $this->table .
                ' (title, content,created) VALUES (:title, :content, :created)');
            foreach ($data as $d){
                $statement->execute($d);
            }
            return true;
        } catch (\PDOException $e) {
            $error = array("message" => $e->getMessage());
        } catch (\Exception $e) {
            $error = array("message" => $e->getMessage());
        }
        $this->log->error(__METHOD__, $error);
        return;
    }

    /**
     * @return array|void
     */
    public function getLastId()
    {
        try {
            $statement = $this->db->query("SELECT id FROM " . $this->table." ORDER BY id DESC LIMIT 1;");
            $row = $statement->fetch(\PDO::FETCH_OBJ);
            if(isset($row->id)) {
                return $row->id;
            }
            return 0;
        } catch (\PDOException $e) {
            $error = array("message" => $e->getMessage());
        } catch (\Exception $e) {
            $error = array("message" => $e->getMessage());
        }
        $this->log->error(__METHOD__, $error);
        return;
    }

    /**
     * @param null $id
     * @return array|mixed|void
     */
    public function getById($id=null)
    {
        try {
            if (!$id) {
                throw new \Exception('Post id should not be null');
            }

            $statement = $this->db->prepare("SELECT * FROM " . $this->table." WHERE id=:id LIMIT 1;");
            $statement->execute(array(':id'=>$id));
            return $statement->fetch(\PDO::FETCH_OBJ);

        } catch (\PDOException $e) {
            $error = array("message" => $e->getMessage());
        } catch (\Exception $e) {
            $error = array("message" => $e->getMessage());
        }
        $this->log->error(__METHOD__, $error);
        return;
    }


    /**
     * @return array
     */
    public function getAll()
    {
        try {
            $statement = $this->db->query("SELECT * FROM " . $this->table." ORDER BY created DESC");
            return $result = $statement->fetchAll(\PDO::FETCH_OBJ);
        } catch (\PDOException $e) {
            $error = array("message" => $e->getMessage());
        } catch (\Exception $e) {
            $error = array("message" => $e->getMessage());
        }
        $this->log->error(__METHOD__, $error);
        return;
    }
}
