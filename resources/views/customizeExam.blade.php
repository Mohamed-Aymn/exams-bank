@extends('components.layouts.account')

@section('content')
    <div class="centralization-container h-[calc(100vh - 80px)] mt-0">
        <form action="/exams" method="POST" class="form h-full">
            @csrf
            <div class="form-control">
                <label class="label">Subject</label>
                <select class="select font-normal" name='subject' required>
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
