@extends('components.layouts.account')

@section('content')
    <div class="centralization-container h-[calc(100vh - 80px)] mt-0">
        <form action="/exams" method="POST" class="form h-full">
            @csrf
            <div class="form-control">
                <label class="label">Subject</label>
                <select class="select font-normal" name='subject' id="subjecet" required>
                    <option disabled selected>Select subject</option>
                    <option value="Physics">Physics</option>
                </select>
            </div>

            <div class="form-control">
                <label class="label">Time</label>
                <div class="join">
                    <input class='input join-item' placeholder="hours" name="hours" required />
                    <input class='input join-item' placeholder="minutes" name="minutes" required/>
                </div>
            </div>

            <div class="form-control ">
                <label class="label">Questions</label>
                <div id="questions-groups">

                    <div>
                        <div class="question-index font-light ml-1">Group 1</div>
                        <div class='question-group join grid grid-cols-12'>
                            <div class="form-control join-item col-span-4">
                                <select class="select font-normal" name="type[]" required>
                                    <option disabled selected>Select Type</option>
                                    <option value="1">MCQ</option>
                                </select>
                            </div>

                            <input class='input join-item col-span-4' placeholder="Number" name="number[]" type='number' required />

                            <div class="form-control join-item col-span-4">
                                <select class="select font-normal" name="level[]" required>
                                    <option disabled selected class="">Level</option>
                                    <option value="1">One</option>
                                    {{-- <option>Two</option> --}}
                                </select>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <button class="btn btn-outline mt-4 w-full" disabled type="button" id="add-group-btn">
                Add Questions group
            </button>
            <div class="flex w-full justify-between mt-auto">
                <button class="btn btn-ghost">Cancel</button>
                <div class="flex gap-2">
                    <button class="btn btn-ghost">save preference</button>
                    <button class="btn btn-primary" type="submit">Start</button>
                </div>
            </div>
        </form>
        <div class="mt-5 alert alert-warning">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
            <span>Warning: form input fields values are not checked before submission (form is not validated) please enter valid fileds to contenue your journey!</span>
          </div>
          <div class="mt-5 alert alert-info">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span>Not all features are made or will be made (typed features in SRS) as this is a Experimental project, and the main purpose is digging deep to real life project and also to explore php/laravel world.</span>
          </div>

    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // get buttons groups container
            let questionsGroups = document.querySelector("#questions-groups")

            // delete button 
            const deleteButton = document.createElement("button");
            deleteButton.textContent = "X"
            deleteButton.classList.add("btn", "btn-error", "join-item", "col-span-1");
            deleteButton.setAttribute("type", "button")
            let deleteHandler = function() {
                const containerToDelete = this.parentNode.parentNode;
                containerToDelete.remove();
                changeIndex();
            }

            let addGroupBtn = document.querySelector("#add-group-btn");
            addGroupBtn.addEventListener('click', function() {
                const copy = questionsGroups.children[0].cloneNode(true);
                questionsGroups.appendChild(copy);
                const deleteButtonCopy = deleteButton.cloneNode(true)
                deleteButtonCopy.addEventListener('click', deleteHandler)
                copy.querySelector('.question-group').appendChild(deleteButtonCopy)
                changeIndex()
            })

            let changeIndex = () => {
                for (let i = 0; i < questionsGroups.children.length; i++) {
                    questionsGroups.children[i].querySelector(".question-index").innerText = "Group " +
                        (i + 1)
                }
            }
        });
    </script>
@endpush
