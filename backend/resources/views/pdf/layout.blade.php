<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #1a1a1a; }
        .header { background: #1e3a5f; color: white; padding: 16px 20px; margin-bottom: 20px; }
        .header h1 { font-size: 18px; font-weight: bold; }
        .header p { font-size: 10px; opacity: 0.8; margin-top: 4px; }
        .badge { display: inline-block; padding: 2px 8px; border-radius: 3px; font-size: 9px; font-weight: bold; }
        .badge-green  { background: #d1fae5; color: #065f46; }
        .badge-red    { background: #fee2e2; color: #991b1b; }
        .badge-yellow { background: #fef3c7; color: #92400e; }
        .badge-blue   { background: #dbeafe; color: #1e40af; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background: #f1f5f9; padding: 7px 8px; text-align: left; font-size: 10px; text-transform: uppercase; color: #475569; border-bottom: 2px solid #e2e8f0; }
        td { padding: 6px 8px; border-bottom: 1px solid #f1f5f9; font-size: 10px; }
        tr:nth-child(even) td { background: #f8fafc; }
        .section-title { font-size: 13px; font-weight: bold; color: #1e3a5f; margin: 16px 0 6px; border-left: 3px solid #1e3a5f; padding-left: 8px; }
        .stats-grid { display: table; width: 100%; margin-bottom: 16px; }
        .stat-box { display: table-cell; background: #f8fafc; border: 1px solid #e2e8f0; padding: 10px; text-align: center; width: 25%; }
        .stat-value { font-size: 18px; font-weight: bold; color: #1e3a5f; }
        .stat-label { font-size: 9px; color: #64748b; margin-top: 2px; }
        .footer { margin-top: 20px; padding-top: 8px; border-top: 1px solid #e2e8f0; font-size: 9px; color: #94a3b8; text-align: center; }
        .content { padding: 0 20px; }
        .info-row { margin-bottom: 4px; font-size: 10px; }
        .info-label { color: #64748b; display: inline-block; width: 120px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>TontinePro — @yield('titre')</h1>
        <p>Généré le {{ now()->format('d/m/Y à H:i') }}</p>
    </div>
    <div class="content">
        @yield('content')
    </div>
    <div class="footer">
        TontinePro • Document confidentiel • Page générée automatiquement
    </div>
</body>
</html>
