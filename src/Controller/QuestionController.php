<?php

namespace App\Controller;

use Twig\Environment;
use Psr\Log\LoggerInterface;
use App\Service\MarkdownHelper;
use Sentry\State\HubInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QuestionController extends AbstractController {

    private LoggerInterface $logger;
    private bool $isDebug;

    public function __construct(LoggerInterface $logger, bool $isDebug){
        $this->logger = $logger;
        $this->isDebug = $isDebug;    
    }

    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage(Environment $twigEnviroment){ 

        $html = $twigEnviroment->render('question/homepage.html.twig');
        
        return new Response($html);
    }

    /**
     *  @Route("/questions/{slug}", name="app_question_show")
     */
    public function show($slug, MarkdownHelper $markdownHelper){
        
        if($this->isDebug){
            $this->logger->info('We are in debug mode!');
        }

        $answers = [
            'Make sure your cat is sitting `purrrfectly` still 🤣',
            'Honestly, I like furry shoes better than MY cat',
            'Maybe... try saying the spell backwards?',
        ];

        $questionText = "I've been turned into a cat, any thoughts on how to turn back? While I'm **adorable**, I don't really care for cat food.";

        $parseQuestionText = $markdownHelper->parse($questionText);

        return $this->render('question/show.html.twig', [
            'question' => ucwords(str_replace('-', ' ', $slug)),
            'questionText' => $parseQuestionText,
            'answers' => $answers
        ]);
    }
}