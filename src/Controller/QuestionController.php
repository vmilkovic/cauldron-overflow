<?php

namespace App\Controller;

use App\Service\MarkdownHelper;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QuestionController extends AbstractController {

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