<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .info {
            text-align: right;
            margin-bottom: 20px;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            color: #666;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    
    <div class="info">
        <strong>{{ __('messages.generation_date') }}:</strong> {{ date('d/m/Y H:i') }}
    </div>

    @if($data->isEmpty())
        <p style="text-align: center; padding: 20px; color: #666;">
            {{ __('messages.no_data_available') }}
        </p>
    @else
        <table>
            <thead>
                <tr>
                    @foreach($columns as $key => $label)
                        <th>{{ $label }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                    <tr>
                        @foreach($columns as $key => $label)
                            <td>
                                @if(is_object($item))
                                    {{ $item->$key ?? '-' }}
                                @else
                                    {{ $item[$key] ?? '-' }}
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div class="footer">
        <p>© {{ date('Y') }} {{ __('messages.app_title') }} - {{ __('messages.rights_reserved') }}</p>
    </div>
</body>
</html>
