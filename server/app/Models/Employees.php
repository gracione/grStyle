<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Http\Controllers\API\Constantes;

class Employees extends Model
{
    use HasFactory;

    protected $table = 'employee';

    protected $fillable = [
        'id_user',
        'id_profissao',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class, 'id_profissao');
    }

    public function listar()
    {
        $query = $this->select(
            'user.name as name',
            'user.id as id',
            DB::raw('group_concat(profession.name) as profession')
        )
        ->join('user', 'employee.id_user', '=', 'user.id')
        ->join('profession', 'employee.id_profissao', '=', 'profession.id')
        ->groupBy('name', 'id');
    
    $results = $query->get();
    return $results->toArray();
    }

    public function getFuncionariosAndProfissao()
    {
        $select = $this->select(
            'user.name as name',
            'employee.id as id',
            'profession.name as profession',
            'employee.id as id_employee',
            'profession.id as id_profissao'
        )
            ->join('user', 'employee.id_user', '=', 'user.id')
            ->join('profession', 'employee.id_profissao', '=', 'profession.id');

        $tipoUsuario = auth()->user()->user_type;
        $idUsuario = auth()->user()->id;
            
        if ($tipoUsuario == Constantes::FUNCIONARIO) {
            $select = $select->where('employee.id_user', $idUsuario);
        }

        return $select->get()->toArray();
    }

    public function listEmployeesWithUserId()
    {
        $select = $this->select(
            'user.name as name',
            'profession.name as profession',
            'employee.id_user',
            'profession.id as id_profissao'
        )
            ->join('user', 'employee.id_user', '=', 'user.id')
            ->join('profession', 'employee.id_profissao', '=', 'profession.id');

        $tipoUsuario = auth()->user()->user_type;
        $idUsuario = auth()->user()->id;
            
        if ($tipoUsuario == Constantes::FUNCIONARIO) {
            $select = $select->where('employee.id_user', $idUsuario);
        }

        return $select->get()->toArray();
    }


    public function getByIdUsuario($id)
    {
        return $this->select(
            'user.name as name',
            'employee.id as id',
            'user.id as id_user',
            'user.number as number',
            'user.email as email',
            'user.id_gender as id_gender',
            'profession.name as profession',
            'profession.id as id_profissao'
        )
            ->join('user', 'employee.id_user', '=', 'user.id')
            ->join('profession', 'employee.id_profissao', '=', 'profession.id')
            ->where('user.id', $id)
            ->get()->first()
            ->toArray();
    }

    public static function getIdUsuarioByIdFuncionario($id)
    {
        return self::select('id_user as id')
            ->where('id', $id)
            ->pluck('id')
            ->first();
    }

    public function getByIdFuncionario($request)
    {
        $id = !empty($request->id) ? $request->id : $request;

        return $this->select(
            'user.name as name',
            'employee.id as id',
            'user.id as id_user',
            'user.number as number',
            'user.email as email',
            'user.id_gender as id_gender'
        )
            ->join('user', 'employee.id_user', '=', 'user.id')
            ->where('employee.id_user', $id)
            ->first()->toArray();
    }

    public function inserir($request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:user',
        ]);

        if ($validator->fails()) {
            return false;
        }

        $user = User::create([
            'name' => $request->name,
            'number' => $request->number,
            'user_type' => '2',
            'id_gender' => $request->id_gender,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'img_url' => './perfil/sem_usuario.png'
        ]);

        foreach ($request->profissoesCadastradas as $key => $idProfissao) {
            self::create([
                'id_user' => $user->id,
                'id_profissao' => $idProfissao
            ]);
        }

        HorarioTrabalho::create([
            'inicio1' => $request->inicioExpediente . ":00",
            'fim1' => $request->inicioAlmoco . ":00",
            'inicio2' => $request->fimAlmoco . ":00",
            'fim2' => $request->fimExpediente . ":00",
            'id_user' => $user->id
        ]);

        return true;
    }

    public function destroyByIdUsuario($idUsuario)
    {
        try {
            DB::table('folga')->where('id_user', $idUsuario)->delete();
            DB::table('employee')->where('id_user', $idUsuario)->delete();
            DB::table('horario_trabalho')->where('id_user', $idUsuario)->delete();
            DB::table('user')->where('id', $idUsuario)->delete();
        } catch (Exception $e) {
            return false;
        }

        return true;
    }

    public function destroyByIdFuncionario($idFuncionario)
    {

        try {
            $idUsuario = self::getIdUsuarioByIdFuncionario($idFuncionario);

            $result = $this->select('*')
                ->join('user', 'employee.id_user', '=', 'user.id')
                ->where('user.id', $idUsuario)
                ->get()
                ->toArray();
            if (count($result) > 1) {
                DB::table('employee')->where('id', $idFuncionario)->delete();
            }
        } catch (Exception $e) {
            return false;
        }

        return true;
    }

    public function alterar($request)
    {
        $ar = $request->all();

        if (!empty($ar['profissoesAlteradas'])) {
            foreach ($ar['profissoesAlteradas'] as $key => $value) {
                if ($value == '-1') {
                    if (count(Funcionarios::getByIdUsuario($ar['id'])) > 1) {
                        DB::table('employee')->where('id', $key)->delete();
                    }
                } else if ($value != '-1') {
                    DB::table('employee')->where('id', $key)->update(['id_profissao' => $value]);
                }
            }
            unset($ar['profissoesAlteradas']);
        }

        if (!empty($ar['profissoesCadastradas'])) {
            foreach ($ar['profissoesCadastradas'] as $key => $value) {
                if (!empty($value)) {
                    DB::table('employee')->insert(['id_user' => $ar['id'], 'id_profissao' => $value]);
                }
            }
            unset($ar['profissoesCadastradas']);
        }

        if (!empty(array_filter($request->expediente))) {
            DB::table('horario_trabalho')
                ->where('id_user', '=', $request->id)
                ->update(array_filter($request->expediente));
        }
        unset($ar['expediente']);

        if (!empty($request->name) || !empty($request->number)) {
            $ar = array_filter($ar);
            DB::table('user')
                ->where('id', '=', $request->id)
                ->update($ar);
        }

        return true;
    }
}
