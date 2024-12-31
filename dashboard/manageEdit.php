<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $articleId = isset($_POST['articleId']) ? $_POST['articleId'] : null;
    $formData = isset($_POST['formData']) ? $_POST['formData'] : [];
    $_SESSION['message'] = '¡Content saved correctly!';

    if ($articleId === null) {
        http_response_code(400);
        echo 'Id not found.';
        exit;
    }

    $jsonString = file_get_contents('../content.json');
    $data = json_decode($jsonString, true);

    $articleUpdated = false;

    foreach ($data['users'] as &$jsonUser) {
        foreach ($jsonUser['articles'] as &$article) {
            if ($article['articleId'] == $articleId) {
                foreach ($formData as $field) {
                    if (isset($field['name']) && isset($field['value'])) {
                        $fieldName = trim($field['name']);
                        $fieldValue = trim($field['value']);

                        if ($fieldName == 'tags') {
                            $tags = array_map('trim', explode(',', $fieldValue));
                            $article['tags'] = $tags;
                        } elseif (strpos($fieldName, 'sections') !== false) {
                            preg_match('/sections\[(\d+)\]\[(\w+)\]/', $fieldName, $matches);
                            $sectionIndex = $matches[1];
                            $sectionField = $matches[2];
                            $article['sections'][$sectionIndex][$sectionField] = $fieldValue;
                        } else {
                            $article[$fieldName] = $fieldValue;
                        }
                    }
                }

                $updatedJsonString = json_encode($data, JSON_PRETTY_PRINT);
                file_put_contents('../content.json', $updatedJsonString);

                $articleUpdated = true;
                break 2; 
            }
        }
    }
}
?>
