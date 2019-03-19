
        $conn = Database::getConnection();
        $conn->insert('field_form')->fields(
          // echo "<pre>"; print_r($conn); die();
          array(
            'fieldlable' => $form_state->getValue('fieldlable'),
            'fieldname' => $form_state->getValue('fieldname'),
            'fieldtype' => $form_state->getValue('fieldtype'),
            //'sender_message' => $form_state->getValue('message'),
          )
        )->execute();
