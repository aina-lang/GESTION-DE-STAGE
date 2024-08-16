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
                <p><strong>ID:</strong> {{ $stage->id }}</p>
                <p><strong>Thème:</strong> {{ $stage->theme }}</p>
                <p><strong>Date de Début:</strong> {{ $stage->start_date }}</p>
                <p><strong>Date de Fin:</strong> {{ $stage->end_date }}</p>
            </div>
        </div>

        <div class="section">
            <h2>Informations du Partenaire</h2>
            <div class="info">
                <p><strong>Sigle du Partenaire:</strong> {{ $stage->partenaire->nom }}</p>
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
    </div>
</body>
</html>
