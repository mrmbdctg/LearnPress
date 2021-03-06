<?php
/**
 * Template for displaying the buttons of a quiz
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 1.0
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$course = LP()->global['course'];
$quiz   = LP()->global['course-item'];
$user   = LP()->user;
if ( !$quiz ) {
	return;
}
$status = $user->get_quiz_status( $quiz->id );
if ( $user->has( 'finished-course', $course->id ) ) {
	return;
}
?>
<div class="quiz-buttons">

	<button class="button-prev-question hide-if-js"><?php esc_html_e('Previous','learnpress');?></button>
	<button class="button-next-question hide-if-js"><?php esc_html_e('Next','learnpress');?></button>

	<?php if ( $remain = $user->can( 'retake-quiz', $quiz->id ) ): ?>
		<button class="button-retake-quiz<?php echo $status != 'completed' ? ' hide-if-js' : ''; ?>" data-id="<?php esc_attr_e( $quiz->id ); ?>" data-security="<?php esc_attr_e( wp_create_nonce( 'retake-quiz-' . $user->id . '-' . $course->id . '-' . $quiz->id ) ); ?>"><?php echo esc_html( sprintf( '%s (+%d)', __( 'Retake', 'learnpress' ), $remain ) ); ?></button>
	<?php endif; ?>

	<?php if ( !$user->has( 'started-quiz', $quiz->id, $course->id ) ): ?>
		<button class="button-start-quiz" data-id="<?php esc_attr_e( $quiz->id ); ?>" data-security="<?php esc_attr_e( wp_create_nonce( 'start-quiz-' . $user->id . '-' . $course->id . '-' . $quiz->id ) ); ?>"><?php esc_html_e( 'Start Quiz', 'learnpress' ); ?></button>
	<?php endif; ?>

	<?php if ( in_array( $status, array( 'started' ) ) ): ?>
		<button class="button-finish-quiz" data-id="<?php esc_attr_e( $quiz->id ); ?>" data-security="<?php esc_attr_e( wp_create_nonce( 'finish-quiz-' . $user->id . '-' . $course->id . '-' . $quiz->id ) ); ?>"><?php esc_html_e( 'Finish Quiz', 'learnpress' ); ?></button>
	<?php endif; ?>

</div>