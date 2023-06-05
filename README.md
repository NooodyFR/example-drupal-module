# example-drupal-module
Example Drupal Module - Based on TMDB API

## TMDB Movies Module

This module integrates with The Movie Database (TMDB) API to display popular movies in Drupal. It provides a new block for showcasing popular movies and a new page to view detailed information about each movie.

## Installation

1. Download and extract the module files into the Drupal modules directory.
2. Enable the "TMDB Movies" module in the Drupal admin panel.

## Requirements

This module has the following requirements:

- Drupal 10 or later.
- A valid TMDB API key. You can obtain one by creating an account on the TMDB website and generating an API key.

## Configuration

1. Modify both `MovieController.php` and `MovieBlock.php` to change your API key.

## Usage

### Block: Popular Movies

1. Edit the desired Drupal page.
2. Add a new block to the page.
3. Select the "Movie Block" block from the available blocks.
5. Save the changes to the page.

### Movie Details Page

The module provides a new page to view detailed information about each movie. To access a movie's details page, use the following URL pattern: `/movie/:id`, where `:id` is the unique identifier of the movie in TMDB.
