# Console Adventure Game

A simple text-based adventure game built with Laravel, featuring interactive room navigation and treasure hunting.

## Source

This application was created as part of the Laraquack project and aims to teach devs silly ways to use Laravel.

## Purpose

The Console Adventure Game demonstrates:
- Laravel Artisan command development
- Interactive console applications
- JSON-based game world configuration
- Basic game state management
- Text-based user interface design

## Installation

1. Ensure you have PHP and Composer installed
2. Clone or navigate to the project directory
3. Run `composer install` in the `src/` directory
4. Copy `.env.example` to `.env` and configure your environment
5. Run `php artisan key:generate`

## Usage

Navigate to the `src/` directory and run:

```bash
php artisan game:play
```

## Game Features

- Interactive text-based adventure
- Room navigation using directional commands (north, south, east, west)
- Treasure hunting objective
- Quit functionality
- JSON-configurable game world

## Game Map

The game world is defined in `storage/app/map.json` and includes:
- Entrance Hall (starting point)
- Dark Corridor
- Ancient Library
- Abandoned Kitchen
- Treasure Room (victory condition)

## Requirements

- PHP 8.1+
- Laravel 12.x
s
## Development

This project uses Laravel Boost for enhanced development experience with AI-powered coding assistance and guidelines.