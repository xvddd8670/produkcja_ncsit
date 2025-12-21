<?php
class TableGenerator {
    
    public static function renderTable($data, $title = '', $edit_row = true) {
        $html = '';
        
        if ($title) {
            $html .= '<h3>' . htmlspecialchars($title) . '</h3>';
        }

        $html .= '<div style="max-height: 400px; overflow-y: auto; border: 1px solid #ccc;">';
        $html .= '<table border="1">';
        $html .= '<tr>';
        if ($edit_row){$html .= '<th>edit</th>';}
        $html .= '<th>ID</th><th>client</th><th>created</th><th>term</th><th>stage</th><th>status</th><th>history</th><th>comment</th></tr>';
        
        foreach ($data as $row) {
            $html .= '<tr>';
            if ($edit_row){
                $html .= '<td>';
                $html .= '<form method="POST" action="templates/edit_row.php">';
                $html .= '<input type="hidden" name="row_id" value="' 
                    . htmlspecialchars($row['ID']) . '">';
                $html .= '<button type="submit">edit</button>';
                $html .= '</form>';
                $html .= '</td>';
            }
            $html .= '<td>' . htmlspecialchars($row['ID']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['client'] ?? '') . '</td>';
            $html .= '<td>' . htmlspecialchars($row['created'] ?? '') . '</td>';
            $html .= '<td>' . htmlspecialchars($row['term'] ?? '') . '</td>';
            $html .= '<td>' . htmlspecialchars($row['stage'] ?? '') . '</td>';
            $html .= '<td>' . htmlspecialchars($row['status'] ?? '') . '</td>';
            $html .= '<td>' . htmlspecialchars($row['history'] ?? '') . '</td>';
            $html .= '<td>' . htmlspecialchars($row['comment'] ?? '') . '</td>';
            $html .= '</tr>';
        }
        
        $html .= '</table>';
        $html .= '</div>'; // Закрываем обертку

        
        return $html;
    }
}
?>
