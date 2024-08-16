<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partenaire;
use Brian2694\Toastr\Facades\Toastr;

class PartenariatController extends Controller
{
    /** Page d'ajout de partenariat */
    public function addPartenaire()
    {
        return view('partenariat.add-partenariat');
    }

    /** Liste des partenariats */
    public function listPartenaires()
    {
        $listPartenaires = Partenaire::all();
        return view('partenariat.list-partenariat', compact('listPartenaires'));
    }

    /** Enregistrer un partenariat */
    public function savePartenaire(Request $request)
    {
        $request->validate([
            'nom'        => 'required|string',
            'email'      => 'required|email',
            'telephone'  => 'required|string',
            'adresse'    => 'required|string',
            'secteur'    => 'required|string',
           
        ]);

        try {
            Partenaire::create([
                'nom'        => $request->nom,
                'email'      => $request->email,
                'telephone'  => $request->telephone,
                'adresse'    => $request->adresse,
                'secteur'    => $request->secteur,
            
            ]);

            Toastr::success('Partenaire ajouté avec succès :)', 'Succès');
            return redirect()->back();
        } catch (\Exception $e) {
            \Log::info($e);
            echo $e;return;
            Toastr::error('Erreur lors de l\'ajout du partenariat :)', 'Erreur');
            return redirect()->back();
        }
    }

    /** Editer un partenariat */
    public function editPartenaire($id)
    {
        $partenariat = Partenaire::find($id);
        return view('partenariat.edit-partenariat', compact('partenariat'));
    }

    /** Mettre à jour un partenariat */
    public function updatePartenaire(Request $request, $id)
    {
        $request->validate([
            'nom'        => 'required|string',
            'email'      => 'required|email',
            'telephone'  => 'required|string',
            'adresse'    => 'required|string',
            'secteur'    => 'required|string',
    
        ]);

        try {
            $partenariat = Partenaire::find($id);
            $partenariat->update([
                'nom'        => $request->nom,
                'email'      => $request->email,
                'telephone'  => $request->telephone,
                'adresse'    => $request->adresse,
                'secteur'    => $request->secteur,
               
            ]);

            Toastr::success('Partenaire mis à jour avec succès :)', 'Succès');
            return redirect()->back();
        } catch (\Exception $e) {
            \Log::info($e);
            Toastr::error('Erreur lors de la mise à jour du partenariat :)', 'Erreur');
            return redirect()->back();
        }
    }

    /** Supprimer un partenariat */
    public function deletePartenaire(Request $request, $id)
    {
        try {
            Partenaire::destroy($id);
            Toastr::success('Partenaire supprimé avec succès :)', 'Succès');
            return redirect()->back();
        } catch (\Exception $e) {
            \Log::info($e);
            Toastr::error('Erreur lors de la suppression du partenariat :)', 'Erreur');
            return redirect()->back();
        }
    }
}
