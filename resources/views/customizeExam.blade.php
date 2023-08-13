@extends('components.layouts.account')

@section('content')
    <div class="centralization-container h-full mt-0">
        {{-- <div class="form-control join-item col-span-3">

            <label class="label">Load from saved preferences</label>
            
            <select class="select">
                <option disabled selected>Chose preference</option>
                <option>first One</option>
                <option>second one</option>
            </select>
        </div>
        <br />
        <hr />
        <br /> --}}
        <form action="/exams" method="POST" class="form h-full">
            @csrf
            {{-- TODO: this should be dropdown --}}
            <div class="form-control">
                <label class="label">Subject</label>
                <select class="select">
                    <option disabled selected>Select subject</option>
                    <option>Physics</option>
                    <option>database</option>
                </select>
            </div>

            <div class="form-control">
                <label class="label">Time</label>

                <div class="join"> <input class='input join-item' placeholder="hours" name="hours" />
                    <input class='input join-item' placeholder="minutes" name="minutes" />
                </div>

            </div>

            <div class="form-control ">
                <label class="label">Questions</label>
                <div id="questions-groups">

                    <div>
                        <div class="question-index font-light ml-1">Group 1</div>
                        <div class='question-group join grid grid-cols-12'>
                            <div class="form-control join-item col-span-3">
                                <select class="select">
                                    <option disabled selected>Select Type</option>
                                    <option>MCQ</option>
                                    <option>True or false</option>
                                </select>
                            </div>

                            <input class='input join-item col-span-3' placeholder="Number" name="number" type='number' />

                            <div class="form-control join-item col-span-3">
                                <select class="select">
                                    <option disabled selected>Level</option>
                                    <option>One</option>
                                    <option>Two</option>
                                </select>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <button class="btn btn-outline mt-4 w-full" type="button" id="add-group-btn">
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
