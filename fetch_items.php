<?php
      include 'config.php';
      $services_query = "SELECT service_id, service_name, service_details, service_picture FROM service";
      $services_result = $con->query($services_query);

      // Initialize the services array
      $services = [];

      // Fetch services and their items
      if ($services_result->num_rows > 0) {
        while ($service = $services_result->fetch_assoc()) {
          $service_id = $service['service_id'];

          // Query to fetch items for the current service
          $items_query = "SELECT item_name,item_id FROM item WHERE service_id = '$service_id'";
          $items_result = $con->query($items_query);

          // Collect subservices (item names)
          $subservices = [];
          if ($items_result->num_rows > 0) {
            while ($item = $items_result->fetch_assoc()) {
              $subservices[] = [
                'name' => $item['item_name'],
                'link' => "service.php?item_id={$item['item_id']}", 
            ];
            }
          }

          // Add service data to the array
          $services[$service['service_name']] = [
            'subservices' => $subservices,
            'image' => $service['service_picture'],
            'text' => $service['service_details'],
            'cardTitle' => $service['service_name'],
            'link' => "service.php?service_id={$service['item_id']}",
            'cardContent' => [
              '✔ ' . $service['service_details'], // Example card content
              '✔ Customize this based on additional data if needed',
            ]
          ];
        }
      }
      // echo "<script>const services = " . str_replace('"', "'", json_encode($services, JSON_PRETTY_PRINT)) . ";</script>";
      echo "<script>const services = " . json_encode($services, JSON_PRETTY_PRINT) . ";</script>";
      ?>