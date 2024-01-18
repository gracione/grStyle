<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Profession extends Model
{
    protected $table = 'profession';
    protected $fillable = ['name'];

    public function list($id = false)
    {
        $query = DB::table('profession')
        ->select('name as profession', 'id');
        if ($id) {
            return $query->where('id', $id)->first();
        }

        return $query->get()->toArray();
    }

    // public function getById($request)
    // {
    //     return $this->select('name')->where('id', $request->id)->get()->toArray();
    // }

    public function getByIdFuncionario($request)
    {
        return $this->select('name', 'profession.id', 'employee.id_user', 'employee.id as id_employee')
            ->join('employee', 'employee.id_profissao', '=', 'profession.id')
            ->where('employee.id', $request->id)
            ->get()->first()->toArray();
    }

    public function getByIdUsuario($idUsuario)
    {
        return $this->select('name', 'profession.id', 'employee.id_user', 'employee.id as id_employee')
            ->join('employee', 'employee.id_profissao', '=', 'profession.id')
            ->where('employee.id_user', $idUsuario)
            ->get()->toArray();
    }

    public function alterar($request)
    {
        if (!empty($request->name)) {
            $this->where('id', $request->id)->update(['name' => $request->name]);
            return true;
        }
        return false;
    }

//    public function inserir($request)
//    {
//        $this->name = $request->name;
//        $this->save();
//        return true;
//    }
}