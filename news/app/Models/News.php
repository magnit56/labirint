<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

//Пришлось сделать кастомную модель, у ларавелевской другой подход - active record
class News
{
    protected $id, $title, $announcement, $body, $tags, $pubDate;

    public function __construct($id)
    {
        $exists = DB::table('news')->where('id', $id)->exists();
        if (!$exists) {
            // лучше какую-нибудь кастомную ошибку вывести типо ArticleNotFound
            // для простоты обычный Exception выбрасываем
            throw new \Exception('Not found');
        }
        $article = DB::table('news')->where('id', $id)->first();
        $tags = DB::table('news_tag')->join('tags', 'news_tag.tag_id', '=', 'tags.id')
            ->where('news_tag.news_id', $id)->select('tags.name')->get();

        $this->id = $article->id;
        $this->title = $article->title;
        $this->announcement = $article->announcement;
        $this->body = $article->body;
        $this->pubDate = Carbon::createFromFormat('Y-m-d H:i:s', $article->pubDate)->format('d.m.Y H:i:s');
        $this->tags = $tags->pluck('name');
    }

    public static function create($title, $announcement, $body, $tagString)
    {
        return DB::transaction(function () use ($title, $announcement, $body, $tagString) {
            $id = DB::table('news')->insertGetId([
                'title' => $title,
                'announcement' => $announcement,
                'body' => $body,
            ]);
            $article = new static($id);
            $article->setTags($tagString);
            return new static($id);
        });
    }

    public static function delete($id): bool
    {
        try {
            return DB::transaction(function () use ($id) {
                DB::table('news_tag')->where('news_id', $id)->delete();
                DB::table('news')->where('id', $id)->delete();
                return true;
            });
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        DB::table('users')
            ->where('id', $this->id)
            ->update(['title' => $title]);
        $this->title = $title;
    }

    public function getAnnouncement()
    {
        return $this->announcement;
    }

    public function setAnnouncement($announcement)
    {
        $this->announcement = $announcement;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setBody($body)
    {
        $this->body = $body;
    }

    public function getTags()
    {
        return collect($this->tags)->join(' ');
    }

    public function setTags($tagString)
    {
        $tags = Str::of($tagString)->explode(' ')->filter()->unique()->toArray();
        $id = $this->id;

        DB::transaction(function () use ($id, $tags) {
            DB::table('news_tag')->where('news_id', $id)->delete();

            $tag_ids = array_map(function ($tag) {
                $exists = DB::table('tags')->where('name', $tag)->exists();
                if (!$exists) {
                    return DB::table('tags')->insertGetId([
                        'name' => $tag,
                    ]);
                }
                return DB::table('tags')->where('name', $tag)->first()->id;
            }, $tags);

            foreach ($tag_ids as $tag_id) {
                DB::table('news_tag')->insertGetId([
                    'news_id' => $id,
                    'tag_id' => $tag_id,
                ]);
            }
            return $id;
        });

        $this->tags = $tags;
    }

    public function getPubDate()
    {
        return $this->pubDate;
    }
}
