<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Traits\FeedHelper;

use Carbon\Carbon;

use App\FeedSources;
use App\FeedsItems;

class FeedUpdate extends Command
{

    use FeedHelper;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feed:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Feeds from feed source';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('importing feeds from all sources');

        $allFeedSources = FeedSources::all();

        foreach ($allFeedSources as $feedSource) {
            $this->info($feedSource->title);

            $allFeeds = $this->readFeed($feedSource->url);

            $this->info('Total '.count($allFeeds).' in '.$feedSource->url);

            if (count($allFeeds) > 0 ){

                $totalSaved = 0;

                foreach ($allFeeds as $feed) {

                   if (!isset($feed['pubDate'])){
                        continue;
                   }

                   $createdAt = Carbon::parse($feed['pubDate']);

                   $feedItemSearch = FeedsItems::where('created_at' , $createdAt);
                   $feedItemSearch->where('source_id' , $feedSource->id);

                   if ($feedItemSearch->count() == 0){
                      $feedItem = new FeedsItems();
                      $feedItem->title = $feed['title'];
                      $feedItem->link = $feed['link'];
                      $feedItem->description = $feed['description'];
                      $feedItem->source_id = $feedSource->id;
                      $feedItem->created_at = $createdAt;
                      
                      if ($feedItem->save()){
                        $totalSaved++;
                      }
                   }
                }

                $this->info($totalSaved.' new feeds saved');

            }

        }

        $this->info('Finish');
    }
}
