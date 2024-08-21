<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Liste des Stages</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 100%;
            margin: auto;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Liste des Stages</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Étudiant</th>
                    <th>Partenariat</th>
                    <th>Thème</th>
                    <th>Date de Début</th>
                    <th>Date de Fin</th>
                    <th>Département</th> 
                </tr>
            </thead>
            <tbody>
                @foreach ($stages as $stage)
                    <tr>
                        <td>{{ $stage->id }}</td>
                        <td>{{ $stage->student->Nom }} {{ $stage->student->Prenoms }}</td>
                        <td>{{ $stage->partenaire->nom }}</td>
                        <td>{{ $stage->theme }}</td>
                        <td>{{ $stage->start_date }}</td>
                        <td>{{ $stage->end_date }}</td>
                        <td>
                            @if ($stage->student->department)
                                {{ $stage->student->department->name }}
                            @else
                                Aucun département associé
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
