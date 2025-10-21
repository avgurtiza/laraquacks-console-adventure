<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GamePlayCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:play';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start an interactive text-based adventure game';

    /**
     * Game world data
     */
    private array $rooms = [];
    private string $currentRoom;
    private string $treasureRoom;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->loadGameWorld();

        if (empty($this->rooms)) {
            return;
        }

        $this->startGame();
    }

    /**
     * Load game world from JSON file
     */
    private function loadGameWorld(): void
    {
        $mapPath = storage_path('app/map.json');
        $mapData = json_decode(file_get_contents($mapPath), true);

        if (!$mapData) {
            $this->error('Failed to load game map!');
            return;
        }

        $this->rooms = $mapData['rooms'];
        $this->currentRoom = $mapData['starting_room'];
        $this->treasureRoom = $mapData['treasure_room'];
    }

    /**
     * Start the game loop
     */
    private function startGame(): void
    {
        $this->info('Welcome to the Console Adventure Game!');
        $this->info('Type "quit" to exit the game.');

        while (true) {
            $this->displayCurrentRoom();

            $input = $this->ask('What do you want to do?');

            if (strtolower($input) === 'quit') {
                $this->info('Thanks for playing! Goodbye.');
                break;
            }

            $this->handleMovement($input);
        }
    }

    /**
     * Display current room information
     */
    private function displayCurrentRoom(): void
    {
        $room = $this->rooms[$this->currentRoom];
        $this->line('');
        $this->info($room['name']);
        $this->line($room['description']);
        $this->line('Exits: ' . implode(', ', array_keys($room['exits'])));
    }

    /**
     * Handle player movement
     */
    private function handleMovement(string $direction): void
    {
        $direction = strtolower($direction);
        $room = $this->rooms[$this->currentRoom];

        if (!isset($room['exits'][$direction])) {
            $this->error('You cannot go that way!');
            $this->line('Available exits: ' . implode(', ', array_keys($room['exits'])));
            return;
        }

        $this->currentRoom = $room['exits'][$direction];

        if ($this->currentRoom === $this->treasureRoom) {
            $this->displayCurrentRoom();
            $this->info('Congratulations! You found the treasure!');
            exit(0);
        }
    }
}
