<?php

namespace App\Factory;

use App\Entity\Question;
use App\Repository\QuestionRepository;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Question|Proxy createOne(array $attributes = [])
 * @method static Question[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static Question|Proxy findOrCreate(array $attributes)
 * @method static Question|Proxy random(array $attributes = [])
 * @method static Question|Proxy randomOrCreate(array $attributes = [])
 * @method static Question[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Question[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static QuestionRepository|RepositoryProxy repository()
 * @method Question|Proxy create($attributes = [])
 */
final class QuestionFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://github.com/zenstruck/foundry#factories-as-services)
    }

    public function unpublished(): self
    {
        return $this->addState(['askedAt' => null]);
    }

    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->realText(50),
            'question' => self::faker()->paragraph(
                self::faker()->numberBetween(1, 4),
                true
            ),
            'askedAt' => self::faker()->dateTimeBetween('-100 days', '-1 minute'),
            'votes' => rand(-20, 50),
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->afterInstantiate(function(Question $question) {
            //     if(!$question->getSlug()){
            //         $slugger = new AsciiSlugger();
            //         $question->setSlug($slugger->slug($question->getName()));
            //     }
            // })
        ;
    }

    protected static function getClass(): string
    {
        return Question::class;
    }
}
