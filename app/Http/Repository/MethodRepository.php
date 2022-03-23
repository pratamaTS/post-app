<?php

namespace App\Http\Repository;

use Illuminate\Support\Facades\DB;

class MethodRepository
{
    protected $detail;

    public function getDataDetail($class, $id)
    {
        $this->detail = $class->firstWhere('id', $id);

        return $this->detail;
    }

    public function getData($class){
        
        $callback = $class->get();

        return $callback;
    }
    
    public function storeOrUpdate($class, $data)
    {  
        DB::beginTransaction();
        try { 
            $class = $class?: new $class;
            $class->fill($data);
            $class->save();

            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $class->refresh();
    }

    public function delete($class)
    {
        $class->delete();

        return $class;
    }
}