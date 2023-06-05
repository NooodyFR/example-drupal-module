<?php

namespace Drupal\movie_blocks\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a Popular Movies block.
 *
 * @Block(
 *   id = "movie_block",
 *   admin_label = @Translation("Movie Block")
 * )
 */
class MovieBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return ['label_display' => FALSE];
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $bearer = "TMDB-BEARER-TOKEN";
    $url = "https://api.themoviedb.org/3/movie/popular?language=fr-FR&page=1";

    $data = $this->fetchData($url, $bearer);


    $renderable = [
      '#theme' => 'popular_movies',
      '#data' => $data,
    ];

    return $renderable;
  }

  private function fetchData($url, $bearer) {
    // Setting headers, including bearer
    $headers = [
      'Accept' => 'application/json',
      'Authorization' => "Bearer $bearer",
    ];

    $options = [
      'headers' => $headers,
    ];

    $client = \Drupal::httpClient();
    $tmdbResponse = $client->get($url, $options);

    if ($tmdbResponse->getStatusCode() == 200) {
      // Response is valid, processing data
      $parsedData = json_decode($tmdbResponse->getBody()->getContents(), TRUE);
      return array_slice($parsedData["results"], 0, 6);
    }
    else {
      return "Invalid response";
    }
  }

}

?>
