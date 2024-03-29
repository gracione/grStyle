<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
//use Auth;
//use Validator;
use App\Models\User;
//use App\Traits\ApiResponser;
//use App\Http\Controllers\API\Constantes;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Storage;
//use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function listar(Request $request)
    {
        return $this->user->listar($request);
    }
    public function registrarCliente(Request $request)
    {
        echo "test";
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'number' => 'required|string|max:255',
            'id_gender' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user',
            'password' => 'required|string|min:3',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'number' => $request->number,
            'user_type' => '3',
            'id_gender' => $request->id_gender,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'img_url' => './perfil/sem_usuario.png',
        ]);

        DB::table('client')->insert([
            'id_user' => $user->id,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user_type' => $user->user_type,
            'name' => $user->name,
            'id_user' => $user->id,
            'data' => $user,
            'token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
    ///
    public function login(Request $request)
    {
        if (!empty($request['googleId'])) {
            $idGoogle = $request['googleId'];

            $userGoogle = DB::table('user')
                ->where('id_google', $idGoogle)
                ->get();

            if (empty($userGoogle['0']->email)) {
                $user = User::create([
                    'name' => $request['name'],
                    'number' => '23',
                    'user_type' => '3',
                    'id_gender' => 3,
                    'email' => $request['email'],
                    'password' => Hash::make('123'),
                    'id_google' => $idGoogle,
                    'img_url' => $request['imageUrl'] ?? null
                ]);

                DB::table('client')->insert([
                    'id_user' => $user['id']
                ]);

                $token = $user->createToken('auth_token')->plainTextToken;

                return response()->json(['user_type' => $user['user_type'], 'name' => $user['name'], 'id_user' => $user['id'], 'data' => $user, 'img_url' => $user['img_url'], 'token' => $token, 'token_type' => 'Bearer',]);
            }
        } else if (!Auth::attempt($request->only('email', 'password'))) {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['user_type' => $user['user_type'], 'name' => $user['name'], 'id_user' => $user['id'], 'img_url' => $user['img_url'], 'token' => $token]);
    }

    public function dadosConfiguracao(Request $request)
    {
        return auth()->user();
    }

    public function sair()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Você saiu com sucesso e o token foi excluído com sucesso'
        ];
    }
    public function enviarImagem(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image = $request->file('image');
        $publicPath = public_path('/perfil');
        $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move($publicPath, $imageName);

        $idUsuario = auth()->user()->id;
        $user = User::find($idUsuario);
        $publicPath = public_path('perfil/' . $imageName);

        if (file_exists($publicPath)) {
            $imageContent = file_get_contents($publicPath);
            $imageData = base64_encode($imageContent);
            $imageSrc = 'data:image/' . pathinfo($publicPath, PATHINFO_EXTENSION) . ';base64,' . $imageData;
        }
        $user->img_url = $imageSrc;
        $user->save();
        return $imageSrc;
    }
    public function alterar(Request $request)
    {
        return User::alterar($request);
    }
}
