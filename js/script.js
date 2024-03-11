// DOM content loaded before executing the code
document.addEventListener('DOMContentLoaded', function() {
    
    // Fetch necessary elements
    const addExerciseBtn = document.getElementById('addExerciseBtn');
    const exerciseContainer = document.getElementById('exerciseContainer');
    const toggleWorkoutDataBtn = document.getElementById('toggleWorkoutDataBtn');
    const workoutDataHeader = document.getElementById('workoutDataHeader');
    const workoutDataContainer = document.getElementById('workoutDataContainer');

    // Hide "Workout Data" section
    workoutDataContainer.style.display = 'none';
    workoutDataHeader.style.display = 'none';

    // SHOW/HIDE WORKOUT DATA button
    toggleWorkoutDataBtn.addEventListener('click', function() {
        if (workoutDataContainer.style.display === 'none') {
            workoutDataContainer.style.display = 'block';
            workoutDataHeader.style.display = 'block';
            toggleWorkoutDataBtn.textContent = 'Hide Workout Data';
        } else {
            workoutDataContainer.style.display = 'none';
            workoutDataHeader.style.display = 'none';
            toggleWorkoutDataBtn.textContent = 'Show Workout Data';
        }
    });

    // ADD EXERCISE button
    addExerciseBtn.addEventListener('click', function() {
        addExerciseRow(); 
    });

    // Exercise container
    exerciseContainer.addEventListener('click', function(event) {
        if (event.target.classList.contains('duplicateBtn')) {
            duplicateExerciseRow(event.target.closest('.exerciseRow'));
        } else if (event.target.classList.contains('deleteBtn')) {
            deleteExerciseRow(event.target.closest('.exerciseRow'));
        }
    });

    // Function to add a new row
    function addExerciseRow() {
        const exerciseRow = document.createElement('div');
        exerciseRow.classList.add('exerciseRow');
        exerciseRow.innerHTML = `
            <select name="exerciseType[]" id="exerciseType">
                <option value="default">Select an exercise</option>
                <optgroup label="Lower Body">
                    <option value="deadlift">Deadlift</option>
                    <option value="barbellSquat">Barbell Squat</option>
                </optgroup>
                <optgroup label="Upper Body">
                    <option value="benchPress">Bench Press</option>
                    <option value="bicepCurl">Bicep Curl</option>
                </optgroup>
            </select>
            <input type="text" name="weights[]" placeholder="Weights (kg)">
            <input type="text" name="reps[]" placeholder="Reps">
            <button type="button" class="duplicateBtn">Duplicate</button>
            <button type="button" class="deleteBtn">Delete</button>
        `;
        exerciseContainer.appendChild(exerciseRow);
    }

    // Function to duplicate a row
    function duplicateExerciseRow(row) {
        const newRow = row.cloneNode(true);
        const originalSelect = row.querySelector('select');
        const duplicatedSelect = newRow.querySelector('select');
        duplicatedSelect.value = originalSelect.value;
        exerciseContainer.appendChild(newRow);
    }

    // Function to delete a row
    function deleteExerciseRow(row) {
        row.remove();
    }
});
