<?php

namespace Drupal\movie_blocks\Controller;
use Drupal\Core\Controller\ControllerBase;

class MovieController extends ControllerBase {

  public function viewMovie($id) {
    $bearer = "TMDB-BEARER-TOKEN";
    $data = json_decode($this->fetchData($id, $bearer), TRUE);
    $data2 = $this->fetchProviders($id, $bearer);
    $combinedData = array_merge($data, $data2);

    $services = 0;
    $build = [
      '#theme' => 'current_movie',
      '#data' => $combinedData,
      '#title' => $data["title"],
    ];

    return $build;
  }

  private function fetchData($id, $bearer) {
    // Setting headers, including bearer
    $headers = [
      'Accept' => 'application/json',
      'Authorization' => "Bearer $bearer",
    ];

    $options = [
      'headers' => $headers,
    ];

    $client = \Drupal::httpClient();
    $tmdbResponse = $client->get("https://api.themoviedb.org/3/movie/$id?language=fr-FR", $options);

    if ($tmdbResponse->getStatusCode() == 200) {
      return $tmdbResponse->getBody()->getContents();
    }
    else {
      return "";
    }
  }

  private function fetchProviders($id, $bearer) {
    // Setting headers, including bearer
    $headers = [
      'Accept' => 'application/json',
      'Authorization' => "Bearer $bearer",
    ];

    $options = [
      'headers' => $headers,
    ];

    $client = \Drupal::httpClient();
    $tmdbResponse = $client->get("https://api.themoviedb.org/3/movie/$id/watch/providers", $options);

    if ($tmdbResponse->getStatusCode() == 200) {
      $results = json_decode($tmdbResponse->getBody()
        ->getContents(), TRUE)["results"];

      if (array_key_exists('FR', $results)) {
        return $results["FR"];
      }
      else {
        return ["nothing" => TRUE];
      }
    }
    else {
      return "";
    }
  }

}

?>
