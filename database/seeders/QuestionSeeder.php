<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            // Science - Easy
            ['category' => 'Science', 'difficulty' => 'easy', 'content' => 'What is the chemical symbol for gold?', 'answer' => 'Au', 'hint' => 'Think of the abbreviation used on jewelry.'],
            ['category' => 'Science', 'difficulty' => 'easy', 'content' => 'How many planets are in our solar system?', 'answer' => '8', 'hint' => 'Pluto was reclassified in 2006.'],
            ['category' => 'Science', 'difficulty' => 'easy', 'content' => 'What is the smallest unit of life?', 'answer' => 'Cell', 'hint' => 'It\'s the basic building block of all living organisms.'],
            ['category' => 'Science', 'difficulty' => 'easy', 'content' => 'What gas do plants absorb from the atmosphere?', 'answer' => 'Carbon dioxide', 'hint' => 'It\'s used in photosynthesis.'],

            // Science - Medium
            ['category' => 'Science', 'difficulty' => 'medium', 'content' => 'What is the speed of light in vacuum?', 'answer' => '299,792,458 m/s', 'hint' => 'Approximately 3 × 10^8 meters per second.'],
            ['category' => 'Science', 'difficulty' => 'medium', 'content' => 'What is the chemical formula for water?', 'answer' => 'H2O', 'hint' => 'It consists of two hydrogen atoms and one oxygen atom.'],
            ['category' => 'Science', 'difficulty' => 'medium', 'content' => 'What is the powerhouse of the cell?', 'answer' => 'Mitochondria', 'hint' => 'It produces ATP for energy.'],
            ['category' => 'Science', 'difficulty' => 'medium', 'content' => 'What is the process by which plants make their own food?', 'answer' => 'Photosynthesis', 'hint' => 'It requires sunlight.'],

            // Science - Hard
            ['category' => 'Science', 'difficulty' => 'hard', 'content' => 'What is the Heisenberg Uncertainty Principle?', 'answer' => 'You cannot simultaneously know both the position and momentum of a particle with perfect accuracy', 'hint' => 'It relates to quantum mechanics.'],
            ['category' => 'Science', 'difficulty' => 'hard', 'content' => 'What is the name of the theory that explains the origin of the universe?', 'answer' => 'Big Bang Theory', 'hint' => 'It suggests the universe began from a single point.'],

            // History - Easy
            ['category' => 'History', 'difficulty' => 'easy', 'content' => 'In what year did Columbus sail to America?', 'answer' => '1492', 'hint' => 'Remember: In 1492, Columbus sailed the ocean blue.'],
            ['category' => 'History', 'difficulty' => 'easy', 'content' => 'Who was the first President of the United States?', 'answer' => 'George Washington', 'hint' => 'His face is on the dollar bill.'],
            ['category' => 'History', 'difficulty' => 'easy', 'content' => 'In what year did World War II end?', 'answer' => '1945', 'hint' => 'Japan surrendered after August 1945.'],

            // History - Medium
            ['category' => 'History', 'difficulty' => 'medium', 'content' => 'What was the primary cause of the French Revolution?', 'answer' => 'Economic crisis and inequality', 'hint' => 'It involved financial troubles and class struggle.'],
            ['category' => 'History', 'difficulty' => 'medium', 'content' => 'Who signed the Magna Carta?', 'answer' => 'King John of England', 'hint' => 'It was signed in 1215.'],

            // History - Hard
            ['category' => 'History', 'difficulty' => 'hard', 'content' => 'What was the primary purpose of the Potsdam Conference?', 'answer' => 'To decide the fate of defeated Germany and plan the post-war world', 'hint' => 'It happened in 1945 after WWII in Europe ended.'],

            // Geography - Easy
            ['category' => 'Geography', 'difficulty' => 'easy', 'content' => 'What is the capital of France?', 'answer' => 'Paris', 'hint' => 'It\'s known as the City of Light.'],
            ['category' => 'Geography', 'difficulty' => 'easy', 'content' => 'Which is the largest continent by area?', 'answer' => 'Asia', 'hint' => 'It contains countries like China and India.'],
            ['category' => 'Geography', 'difficulty' => 'easy', 'content' => 'What is the capital of Japan?', 'answer' => 'Tokyo', 'hint' => 'It\'s the largest city in Japan.'],

            // Geography - Medium
            ['category' => 'Geography', 'difficulty' => 'medium', 'content' => 'What is the longest river in Africa?', 'answer' => 'Nile River', 'hint' => 'It flows through Egypt.'],
            ['category' => 'Geography', 'difficulty' => 'medium', 'content' => 'Which country has the most time zones?', 'answer' => 'France', 'hint' => 'It includes overseas territories.'],

            // Geography - Hard
            ['category' => 'Geography', 'difficulty' => 'hard', 'content' => 'What is the capital of Burkina Faso?', 'answer' => 'Ouagadougou', 'hint' => 'It\'s in West Africa.'],

            // Technology - Easy
            ['category' => 'Technology', 'difficulty' => 'easy', 'content' => 'Who is credited with inventing the World Wide Web?', 'answer' => 'Tim Berners-Lee', 'hint' => 'He created it in 1989.'],
            ['category' => 'Technology', 'difficulty' => 'easy', 'content' => 'What does HTML stand for?', 'answer' => 'HyperText Markup Language', 'hint' => 'It\'s used to create web pages.'],
            ['category' => 'Technology', 'difficulty' => 'easy', 'content' => 'What is the most popular programming language?', 'answer' => 'Python', 'hint' => 'It\'s named after a comedy troupe.'],

            // Technology - Medium
            ['category' => 'Technology', 'difficulty' => 'medium', 'content' => 'What does API stand for?', 'answer' => 'Application Programming Interface', 'hint' => 'It\'s a way for software to communicate.'],
            ['category' => 'Technology', 'difficulty' => 'medium', 'content' => 'What is the primary function of an operating system?', 'answer' => 'Manage hardware and software resources', 'hint' => 'Examples include Windows, macOS, and Linux.'],

            // Technology - Hard
            ['category' => 'Technology', 'difficulty' => 'hard', 'content' => 'What is the time complexity of binary search?', 'answer' => 'O(log n)', 'hint' => 'It works on sorted arrays.'],

            // Literature - Easy
            ['category' => 'Literature', 'difficulty' => 'easy', 'content' => 'Who wrote Romeo and Juliet?', 'answer' => 'William Shakespeare', 'hint' => 'He was an English playwright and poet.'],
            ['category' => 'Literature', 'difficulty' => 'easy', 'content' => 'What is the first book in the Harry Potter series?', 'answer' => 'Harry Potter and the Philosopher\'s Stone', 'hint' => 'Harry first learns he is a wizard in this book.'],

            // Literature - Medium
            ['category' => 'Literature', 'difficulty' => 'medium', 'content' => 'Who wrote One Hundred Years of Solitude?', 'answer' => 'Gabriel García Márquez', 'hint' => 'He was a Colombian author.'],

            // Literature - Hard
            ['category' => 'Literature', 'difficulty' => 'hard', 'content' => 'What is the narrative technique used in James Joyce\'s Ulysses?', 'answer' => 'Stream of consciousness', 'hint' => 'It involves the free flow of a character\'s thoughts.'],

            // Sports - Easy
            ['category' => 'Sports', 'difficulty' => 'easy', 'content' => 'How many players are on a basketball team on the court?', 'answer' => '5', 'hint' => 'It\'s the starting lineup.'],
            ['category' => 'Sports', 'difficulty' => 'easy', 'content' => 'In which sport is a "love" score used?', 'answer' => 'Tennis', 'hint' => 'Love means zero points.'],

            // Sports - Medium
            ['category' => 'Sports', 'difficulty' => 'medium', 'content' => 'How many Grand Slam tournaments are there in tennis?', 'answer' => '4', 'hint' => 'Australian Open, French Open, Wimbledon, and US Open.'],

            // Sports - Hard
            ['category' => 'Sports', 'difficulty' => 'hard', 'content' => 'Which athlete has won the most Olympic gold medals?', 'answer' => 'Michael Phelps', 'hint' => 'He is a swimmer.'],

            // Music - Easy
            ['category' => 'Music', 'difficulty' => 'easy', 'content' => 'How many strings does a standard guitar have?', 'answer' => '6', 'hint' => 'It\'s a common acoustic instrument.'],
            ['category' => 'Music', 'difficulty' => 'easy', 'content' => 'What is the fastest musical tempo called?', 'answer' => 'Presto', 'hint' => 'It means very fast.'],

            // Music - Medium
            ['category' => 'Music', 'difficulty' => 'medium', 'content' => 'How many keys does a standard piano have?', 'answer' => '88', 'hint' => 'It includes white and black keys.'],

            // Music - Hard
            ['category' => 'Music', 'difficulty' => 'hard', 'content' => 'What is the interval between C and G called?', 'answer' => 'Perfect fifth', 'hint' => 'It spans 7 semitones.'],

            // Movies - Easy
            ['category' => 'Movies', 'difficulty' => 'easy', 'content' => 'Who directed Titanic?', 'answer' => 'James Cameron', 'hint' => 'He also directed Avatar.'],
            ['category' => 'Movies', 'difficulty' => 'easy', 'content' => 'What year was Jaws released?', 'answer' => '1975', 'hint' => 'It was directed by Steven Spielberg.'],

            // Movies - Medium
            ['category' => 'Movies', 'difficulty' => 'medium', 'content' => 'How many Academy Awards did Parasite win in 2020?', 'answer' => '4', 'hint' => 'It won Best Picture.'],

            // Movies - Hard
            ['category' => 'Movies', 'difficulty' => 'hard', 'content' => 'What is the highest-grossing film of all time (as of 2024)?', 'answer' => 'Avatar: The Way of Water', 'hint' => 'It\'s a James Cameron film.'],

            // Mathematics - Easy
            ['category' => 'Mathematics', 'difficulty' => 'easy', 'content' => 'What is 5 + 3 × 2?', 'answer' => '11', 'hint' => 'Follow the order of operations.'],
            ['category' => 'Mathematics', 'difficulty' => 'easy', 'content' => 'What is the square root of 144?', 'answer' => '12', 'hint' => '12 × 12 = 144.'],

            // Mathematics - Medium
            ['category' => 'Mathematics', 'difficulty' => 'medium', 'content' => 'What is the sum of angles in a triangle?', 'answer' => '180 degrees', 'hint' => 'It\'s a fundamental property of triangles.'],

            // Mathematics - Hard
            ['category' => 'Mathematics', 'difficulty' => 'hard', 'content' => 'What is the derivative of x³?', 'answer' => '3x²', 'hint' => 'Use the power rule.'],

            // Art - Easy
            ['category' => 'Art', 'difficulty' => 'easy', 'content' => 'Who painted the Mona Lisa?', 'answer' => 'Leonardo da Vinci', 'hint' => 'It\'s the most famous painting in the world.'],
            ['category' => 'Art', 'difficulty' => 'easy', 'content' => 'What art movement is Pablo Picasso famous for?', 'answer' => 'Cubism', 'hint' => 'It involves geometric shapes.'],

            // Art - Medium
            ['category' => 'Art', 'difficulty' => 'medium', 'content' => 'Who created the sculpture "The Thinker"?', 'answer' => 'Auguste Rodin', 'hint' => 'It\'s a famous French sculpture.'],

            // Art - Hard
            ['category' => 'Art', 'difficulty' => 'hard', 'content' => 'What is the primary focus of Abstract Expressionism?', 'answer' => 'Spontaneous, non-representational emotional expression through color and form', 'hint' => 'It emerged in the mid-20th century.'],
            [
                'category' => 'الدوري التونسي',
                'difficulty' => 'easy',
                'content' => 'ما هو الفريق الذي فاز بالدوري التونسي في موسم 2023؟',
                'answer' => 'الترجي الرياضي التونسي',
                'hint' => 'إنه أحد أنجح الأندية التونسية.'
            ],
            [
                'category' => 'الدوري التونسي',
                'difficulty' => 'easy',
                'content' => 'أي مدينة هي مقر النادي الإفريقي؟',
                'answer' => 'تونس',
                'hint' => 'إنها عاصمة تونس.'
            ],
            [
                'category' => 'الدوري التونسي',
                'difficulty' => 'easy',
                'content' => 'ما عدد الفرق المشاركة في الدوري التونسي للموسم الحالي؟',
                'answer' => '16',
                'hint' => 'عادةً ما يشارك حوالي 16 فريقاً.'
            ],

            // Tunisian League - Medium
            [
                'category' => 'الدوري التونسي',
                'difficulty' => 'medium',
                'content' => 'من هو اللاعب الذي سجل أكبر عدد من الأهداف في تاريخ الدوري التونسي؟',
                'answer' => 'محمد أمين بن عمر',
                'hint' => 'هو هداف مشهور لعب لعدة أندية.'
            ],
            [
                'category' => 'الدوري التونسي',
                'difficulty' => 'medium',
                'content' => 'أي فريق يعتبر أكثر الفرق تتويجاً بالدوري التونسي؟',
                'answer' => 'الترجي الرياضي التونسي',
                'hint' => 'لقد فاز بالدوري عشرات المرات.'
            ],
            [
                'category' => 'الدوري التونسي',
                'difficulty' => 'medium',
                'content' => 'ما هو الملعب الرئيسي للنجم الساحلي؟',
                'answer' => 'ملعب الطيب المهيري',
                'hint' => 'يقع في مدينة سوسة.'
            ],

            // Tunisian League - Hard
            [
                'category' => 'الدوري التونسي',
                'difficulty' => 'hard',
                'content' => 'في أي عام تأسس النادي الإفريقي؟',
                'answer' => '1920',
                'hint' => 'واحد من أقدم الأندية التونسية.'
            ],
            [
                'category' => 'الدوري التونسي',
                'difficulty' => 'hard',
                'content' => 'من هو المدرب الذي قاد الترجي الرياضي للتتويج بأكبر عدد من البطولات في تاريخه؟',
                'answer' => 'المدرب الفرنسي الفرنسيان شافر',
                'hint' => 'اشتهر بفترة طويلة مع الترجي.'
            ],
            [
                'category' => 'الدوري التونسي',
                'difficulty' => 'hard',
                'content' => 'أي فريق حقق أكبر فوز في تاريخ مباريات الدوري التونسي؟',
                'answer' => 'الترجي الرياضي التونسي',
                'hint' => 'كانت النتيجة أكثر من 7 أهداف.'
            ],
        ];

        foreach ($questions as $q) {
            Category::where('name', $q['category'])->first()?->questions()->create([
                'content' => $q['content'],
                'answer' => $q['answer'],
                'difficulty' => $q['difficulty'],
                'hint' => $q['hint'],
            ]);
        }
    }
}
