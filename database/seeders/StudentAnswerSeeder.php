<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Student;
use App\Models\StudentExam;
use App\Models\StudentAnswer;

class StudentAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Find a student user to associate these answers with
        // Make sure this email exists from your StudentSeeder!
        $user = User::where('email', 'kulinlog@example.com')->first(); // Using 'Siswa Kuliner Logistik'
        if (!$user || !$user->student) {
            $this->command->info("User 'kulinlog@example.com' or associated student not found. Skipping StudentAnswerSeeder.");
            return;
        }

        $student = $user->student;
        $minatBakatExam = Exam::where('name', 'Minat Bakat')->first();

        if (!$minatBakatExam) {
            $this->command->info("Minat Bakat Exam not found. Skipping StudentAnswerSeeder.");
            return;
        }

        // Ensure the student has an 'in_progress' or 'pending' StudentExam record for Minat Bakat
        // or create one if it doesn't exist
        $studentExam = StudentExam::firstOrCreate(
            ['student_id' => $student->id, 'exam_id' => $minatBakatExam->id],
            [
                'status' => 'in_progress', // Set to in_progress to allow answers to be added
                // 'start_time' => now(), // Not needed for no-timer exam, but good practice if enabling later
            ]
        );

        // Get all Minat Bakat questions
        $minatBakatQuestions = Question::where('exam_id', $minatBakatExam->id)->get();

        // Define which answer options map to which majors (based on your QuestionAnswerSeeder logic)
        // Answer IDs will vary, so we'll pick by meta_data on the answer text if possible,
        // or just pick the first answer in the expected order for A, B, C.
        $answerMap = [
            'Kuliner'    => 'Pilihan A', // Assuming first answer is 'Pilihan A' with meta_data 'Kuliner'
            'Pengelasan' => 'Pilihan B', // Assuming second answer is 'Pilihan B' with meta_data 'Pengelasan'
            'Logistik'   => 'Pilihan C', // Assuming third answer is 'Pilihan C' with meta_data 'Logistik'
        ];

        // Simulate answers for the student
        // We'll aim to recommend 'Kuliner' by having more Kuliner-leaning answers
        $minatBakatQuestions->each(function ($question, $index) use ($studentExam, $answerMap) {
            $chosenAnswer = null;

            // For testing, let's make 3 out of 5 questions lean towards Kuliner
            if ($index < 3) { // First 3 questions for Kuliner
                $chosenAnswer = $question->answers()->where('meta_data', 'Kuliner')->first();
            } else if ($index == 3) { // 1 question for Pengelasan
                $chosenAnswer = $question->answers()->where('meta_data', 'Pengelasan')->first();
            } else { // 1 question for Logistik
                $chosenAnswer = $question->answers()->where('meta_data', 'Logistik')->first();
            }

            if ($chosenAnswer) {
                StudentAnswer::updateOrCreate(
                    ['student_exam_id' => $studentExam->id, 'question_id' => $question->id],
                    ['answer_id' => $chosenAnswer->id]
                );
            } else {
                $this->command->warn("Could not find a suitable answer for question ID: {$question->id} for seeding.");
            }
        });

        // After seeding answers, mark the exam as completed (simulating submission)
        // This is crucial for it to appear in the "completed" status for result viewing.
        // You might need to re-run the `submit` logic from the controller here manually
        // to populate the score/recommendation, or you can manually update the `student_exams` table.
        // For simplicity, we'll just set status to completed. The recommendation logic runs on submit.
        // To properly get the recommendation populated in the session or db, you'd need to
        // call the submit method. For display, the result page calculates it from answers.
        $studentExam->update([
            'status' => 'completed',
            // 'score' => 0, // Minat Bakat score is often 0 or null as it's not traditional scoring
            // 'end_time' => now(), // If you track end_time
        ]);

        $this->command->info("Seeded Minat Bakat answers for user '{$user->email}'.");
    }
}
