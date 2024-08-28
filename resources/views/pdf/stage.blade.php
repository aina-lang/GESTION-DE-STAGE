<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Information du Stage</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 80%;
            margin: auto;
        }

        h1 {
            text-align: center;
        }

        .section {
            margin-bottom: 20px;
        }

        .section h2 {
            background-color: #f4f4f4;
            padding: 10px;
            border-radius: 5px;
        }

        .info {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Information du Stage</h1>

        <div class="section">
            <h2>Informations du Stage</h2>
            <div class="info">
                <p><strong>Matricule:</strong> {{ $stage->student->matricule }}</p>
                <p><strong>Thème:</strong> {{ $stage->theme }}</p>
                <p><strong>Date de Début:</strong> {{ $stage->start_date }}</p>
                <p><strong>Date de Fin:</strong> {{ $stage->end_date }}</p>
            </div>
        </div>

        <div class="section">
            <h2>Informations du Partenaire</h2>
            <div class="info">
                <p><strong>Nom du Partenaire:</strong> {{ $stage->partenaire->nom }}</p>
                <p><strong>Email:</strong> {{ $stage->partenaire->email }}</p>
                <p><strong>Téléphone:</strong> {{ $stage->partenaire->telephone }}</p>
                <p><strong>Adresse:</strong> {{ $stage->partenaire->adresse }}</p>
                <p><strong>Secteur:</strong> {{ $stage->partenaire->secteur }}</p>
            </div>
        </div>

        <div class="section">
            <h2>Informations de l'Étudiant</h2>
            <div class="info">
                <p><strong>Nom :</strong> {{ $stage->student->Nom }}</p>
                <p><strong>Prénom(s) :</strong> {{ $stage->student->Prenoms }}</p>
                <p><strong>Email:</strong> {{ $stage->student->email }}</p>
                <p><strong>Téléphone:</strong> {{ $stage->student->Telephone }}</p>
            </div>
        </div>

        <div class="section">
            <h2>Informations sur le Département</h2>
            <div class="info">
                @if ($stage->student->department)
                    <p><strong>Nom du Département :</strong> {{ $stage->student->department->nom }}</p>
                    <p><strong>Description :</strong> {{ $stage->student->department->description }}</p>
                @else
                    <p>Aucune information sur le département disponible.</p>
                @endif
            </div>
        </div>

        <div class="section">
            <h2>Informations de l'Encadrant</h2>
            <div class="info">
                <p><strong>Nom :</strong> {{ $stage->teacher->Nom }}</p>
                <p><strong>Prénom(s) :</strong> {{ $stage->teacher->Prenoms }}</p>
                <p><strong>Email:</strong> {{ $stage->teacher->email }}</p>
                <p><strong>Téléphone:</strong> {{ $stage->teacher->Telephone }}</p>
                <p><strong>Département :</strong> {{ $stage->teacher->department->name?? 'Non renseigné' }}</p>
            </div>
        </div>
    </div>
</body>

</html>
