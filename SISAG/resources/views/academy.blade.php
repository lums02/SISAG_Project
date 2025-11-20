@extends('layouts.app', ['title' => 'SISAG Academy'])

@section('content')
    <div class="max-w-6xl space-y-8">
        <div>
            <h1 class="text-3xl font-semibold text-gray-900 dark:text-gray-100 tracking-tight">SISAG Academy</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">
                Module pédagogique pour comprendre l'action publique : infographies, quiz et glossaire des termes clés.
            </p>
        </div>

        <!-- Infographies -->
        <section class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm p-6">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 tracking-tight mb-6">Infographies</h2>
            
            <div class="space-y-6">
                <article class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3">Le cycle budgétaire</h3>
                    <div class="grid md:grid-cols-4 gap-4 mt-4">
                        <div class="text-center p-4 bg-emerald-50 dark:bg-emerald-900/20 rounded-lg">
                            <div class="text-2xl font-bold text-emerald-600 dark:text-emerald-400 mb-2">1</div>
                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Préparation</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Définition des besoins et priorités</p>
                        </div>
                        <div class="text-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                            <div class="text-2xl font-bold text-blue-600 dark:text-blue-400 mb-2">2</div>
                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Vote</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Adoption par le Parlement</p>
                        </div>
                        <div class="text-center p-4 bg-amber-50 dark:bg-amber-900/20 rounded-lg">
                            <div class="text-2xl font-bold text-amber-600 dark:text-amber-400 mb-2">3</div>
                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Exécution</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Mise en œuvre des projets</p>
                        </div>
                        <div class="text-center p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                            <div class="text-2xl font-bold text-purple-600 dark:text-purple-400 mb-2">4</div>
                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Contrôle</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Évaluation et audit</p>
                        </div>
                    </div>
                </article>

                <article class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3">Les acteurs du projet public</h3>
                    <div class="space-y-3 mt-4">
                        <div class="flex items-start gap-3 p-3 bg-gray-50 dark:bg-gray-800 rounded-md">
                            <div class="w-2 h-2 rounded-full bg-emerald-500 mt-2"></div>
                            <div>
                                <p class="font-medium text-gray-900 dark:text-gray-100 text-sm">Ministère porteur</p>
                                <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Définit les objectifs et alloue le budget</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 bg-gray-50 dark:bg-gray-800 rounded-md">
                            <div class="w-2 h-2 rounded-full bg-blue-500 mt-2"></div>
                            <div>
                                <p class="font-medium text-gray-900 dark:text-gray-100 text-sm">Maître d'ouvrage</p>
                                <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Pilote la réalisation du projet</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 bg-gray-50 dark:bg-gray-800 rounded-md">
                            <div class="w-2 h-2 rounded-full bg-amber-500 mt-2"></div>
                            <div>
                                <p class="font-medium text-gray-900 dark:text-gray-100 text-sm">Citoyens</p>
                                <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Bénéficiaires et contributeurs via le feedback</p>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </section>

        <!-- Quiz -->
        <section class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm p-6">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 tracking-tight mb-6">Quiz civique</h2>
            
            <div id="quiz-container" class="space-y-6">
                <div id="quiz-question" class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4" id="question-text"></h3>
                    <div id="quiz-answers" class="space-y-2"></div>
                    <button id="quiz-submit" class="mt-4 px-4 py-2 bg-emerald-600 dark:bg-emerald-500 text-white dark:text-gray-900 rounded-md text-sm font-medium hover:bg-emerald-500 dark:hover:bg-emerald-400 transition-colors duration-150 hidden">
                        Valider
                    </button>
                    <div id="quiz-result" class="mt-4 hidden"></div>
                    <button id="quiz-next" class="mt-4 px-4 py-2 bg-emerald-600 dark:bg-emerald-500 text-white dark:text-gray-900 rounded-md text-sm font-medium hover:bg-emerald-500 dark:hover:bg-emerald-400 transition-colors duration-150 hidden">
                        Question suivante
                    </button>
                </div>
                <div id="quiz-score" class="text-center text-sm text-gray-600 dark:text-gray-400"></div>
            </div>
        </section>

        <!-- Glossaire -->
        <section class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm p-6">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 tracking-tight mb-6">Glossaire</h2>
            
            <div class="grid md:grid-cols-2 gap-4">
                @php
                    $glossary = [
                        'Budget' => 'Document prévisionnel qui autorise les recettes et les dépenses de l\'État pour une année.',
                        'Maître d\'ouvrage' => 'Personne ou entité qui commande et finance un projet public.',
                        'Jalon' => 'Étape importante dans le déroulement d\'un projet, servant de point de contrôle.',
                        'Score de transparence' => 'Indicateur calculé sur la base de la complétude des données, du respect des délais et du feedback citoyen.',
                        'Timeline' => 'Chronologie des étapes et jalons d\'un projet, permettant de suivre son avancement.',
                        'Feedback citoyen' => 'Retours, avis et signalements des citoyens sur les projets publics.',
                    ];
                @endphp
                
                @foreach($glossary as $term => $definition)
                    <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                        <h3 class="font-semibold text-gray-900 dark:text-gray-100 text-sm mb-2">{{ $term }}</h3>
                        <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed">{{ $definition }}</p>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection

@push('scripts')
<script>
    const quizData = [
        {
            question: "Qu'est-ce que le SISAG ?",
            answers: [
                { text: "Un système de suivi de l'action gouvernementale", correct: true },
                { text: "Un organisme de contrôle budgétaire", correct: false },
                { text: "Une agence de communication publique", correct: false },
            ]
        },
        {
            question: "Le score de transparence est calculé sur la base de :",
            answers: [
                { text: "Uniquement le budget", correct: false },
                { text: "La complétude, les délais et le feedback citoyen", correct: true },
                { text: "Le nombre de projets", correct: false },
            ]
        },
        {
            question: "Quel est le premier étape du cycle budgétaire ?",
            answers: [
                { text: "Le vote", correct: false },
                { text: "La préparation", correct: true },
                { text: "L'exécution", correct: false },
            ]
        },
    ];

    let currentQuestion = 0;
    let score = 0;
    let selectedAnswer = null;

    function loadQuestion() {
        if (currentQuestion >= quizData.length) {
            showFinalScore();
            return;
        }

        const question = quizData[currentQuestion];
        document.getElementById('question-text').textContent = question.question;
        
        const answersContainer = document.getElementById('quiz-answers');
        answersContainer.innerHTML = '';
        selectedAnswer = null;

        question.answers.forEach((answer, index) => {
            const button = document.createElement('button');
            button.className = 'w-full text-left p-3 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors duration-150 text-sm';
            button.textContent = answer.text;
            button.onclick = () => selectAnswer(index, button);
            answersContainer.appendChild(button);
        });

        document.getElementById('quiz-submit').classList.remove('hidden');
        document.getElementById('quiz-result').classList.add('hidden');
        document.getElementById('quiz-next').classList.add('hidden');
        document.getElementById('quiz-score').textContent = `Question ${currentQuestion + 1} sur ${quizData.length}`;
    }

    function selectAnswer(index, button) {
        // Reset all buttons
        document.querySelectorAll('#quiz-answers button').forEach(btn => {
            btn.classList.remove('bg-emerald-100', 'dark:bg-emerald-900/40', 'border-emerald-500');
        });
        
        // Highlight selected
        button.classList.add('bg-emerald-100', 'dark:bg-emerald-900/40', 'border-emerald-500');
        selectedAnswer = index;
    }

    document.getElementById('quiz-submit').onclick = () => {
        if (selectedAnswer === null) return;

        const question = quizData[currentQuestion];
        const isCorrect = question.answers[selectedAnswer].correct;
        const resultDiv = document.getElementById('quiz-result');
        
        if (isCorrect) {
            score++;
            resultDiv.className = 'mt-4 p-3 bg-emerald-50 dark:bg-emerald-900/40 border border-emerald-200 dark:border-emerald-800 rounded-md text-sm text-emerald-700 dark:text-emerald-300';
            resultDiv.textContent = '✓ Correct !';
        } else {
            resultDiv.className = 'mt-4 p-3 bg-rose-50 dark:bg-rose-900/40 border border-rose-200 dark:border-rose-800 rounded-md text-sm text-rose-700 dark:text-rose-300';
            resultDiv.textContent = '✗ Incorrect. La bonne réponse était : ' + question.answers.find(a => a.correct).text;
        }

        resultDiv.classList.remove('hidden');
        document.getElementById('quiz-submit').classList.add('hidden');
        document.getElementById('quiz-next').classList.remove('hidden');
    };

    document.getElementById('quiz-next').onclick = () => {
        currentQuestion++;
        loadQuestion();
    };

    function showFinalScore() {
        const container = document.getElementById('quiz-container');
        container.innerHTML = `
            <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg p-8 text-center">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Quiz terminé !</h3>
                <p class="text-3xl font-bold text-emerald-600 dark:text-emerald-400 mb-2">${score} / ${quizData.length}</p>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">Vous avez obtenu ${Math.round((score / quizData.length) * 100)}% de bonnes réponses</p>
                <button onclick="location.reload()" class="px-4 py-2 bg-emerald-600 dark:bg-emerald-500 text-white dark:text-gray-900 rounded-md text-sm font-medium hover:bg-emerald-500 dark:hover:bg-emerald-400 transition-colors duration-150">
                    Refaire le quiz
                </button>
            </div>
        `;
    }

    // Load first question
    loadQuestion();
</script>
@endpush

