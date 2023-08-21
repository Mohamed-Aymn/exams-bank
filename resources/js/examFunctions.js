// Exam duration function
export const timeProgress = (duration, timer) => {
    const [h, m, s] = duration.split(':').map(Number);
    const seconds = h * 3600 + m* 60 + s;
    return timer / seconds * 100;
}