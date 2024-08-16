<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
    // Affiche le formulaire d'inscription
    public function register()
    {
        $role = DB::table('role_type_users')->get();
        return view('auth.register', compact('role'));
    }

    public function storeUser(Request $request)
    {
        try {
            // Valider les données de la requête
            $validatedData = $request->validate([
                'name'                    => 'required|string|max:255',
                'email'                   => 'required|string|email|max:255|unique:users',
                'password'                => 'required|string|min:8|confirmed',
                'password_confirmation'   => 'required_with:password|same:password',
                'avatar'                  => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validation pour l'avatar
            ]);

            // Traitement de l'avatar
            if ($request->hasFile('avatar')) {
                $avatarPath = $request->file('avatar')->store('avatars', 'public');
            } else {
                $avatarPath = 'avatars/default_avatar.jpg';
            }

            // Créer l'utilisateur
            User::create([
                'name'      => $validatedData['name'],
                'email'     => $validatedData['email'],
                'join_date' => Carbon::now()->toDayDateTimeString(),
                'password'  => Hash::make($validatedData['password']),
                'avatar'    => $avatarPath,
            ]);

            // Afficher le message de succès
            Toastr::success('Compte créé avec succès :)', 'Succès');

            // Rediriger vers la page de connexion
            return redirect('login');
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation Exception: ' . $e->getMessage());
            Toastr::error('Les données fournies ne sont pas valides.', 'Erreur');
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Illuminate\Database\QueryException $e) {
            \Log::error('Database Query Exception: ' . $e->getMessage());
            Toastr::error('Une erreur est survenue lors de la création du compte.', 'Erreur');
            return redirect()->back()->withInput();
        } catch (\Exception $e) {
            \Log::error('General Exception: ' . $e->getMessage());
            Toastr::error('Une erreur inattendue est survenue.', 'Erreur');
            return redirect()->back()->withInput();
        }
    }



    // Affiche le formulaire d'édition
    public function edit($id)
    {
        $user = User::findOrFail($id); // Trouve l'utilisateur par ID
        $role = DB::table('role_type_users')->get(); // Charge les rôles disponibles
        return view('auth.edit', compact('user', 'role')); // Retourne la vue d'édition avec les données de l'utilisateur
    }

    // Met à jour les informations de l'utilisateur
    public function update(Request $request)
    {
        try {
            // Valider les données de la requête
            $request->validate([
                'name'      => 'required|string|max:255',
                'email'     => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
                'password'  => 'nullable|string|min:8|confirmed',
                'avatar'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validation pour l'avatar
            ]);

            // Trouver l'utilisateur actuellement connecté
            $user = User::findOrFail(Auth::id());

            // Mettre à jour les informations de l'utilisateur
            $user->name = $request->name;
            $user->email = $request->email;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            // Traitement de l'avatar
            if ($request->hasFile('avatar')) {
                // Supprimer l'ancien avatar
                if ($user->avatar && $user->avatar !== 'avatars/default_avatar.jpg') {
                    \Storage::disk('public')->delete($user->avatar);
                }

                // Stocker le nouvel avatar
                $user->avatar = $request->file('avatar')->store('avatars', 'public');
            }

            // Sauvegarder les modifications
            $user->save();

            // Afficher un message de succès
            Toastr::success('Compte mis à jour avec succès :)', 'Succès');
            return redirect()->route('user/profile/page');
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error('Une erreur est survenue lors de la mise à jour du compte.', 'Erreur');
            return redirect()->back()->withInput();
        } catch (\Exception $e) {
            Toastr::error('Une erreur inattendue est survenue.', 'Erreur');
            return redirect()->back()->withInput();
        }
    }
}
