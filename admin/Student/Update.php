﻿<h1 class="text-start my-3 screen-name">Update Student info. </h1>
<div class="card rounded shadow border-0 p-5 text-start col-12">
    <div class="d-grid align-items-center">
        <form method="post">
            <div class="row d-flex justify-content-center">
                <div class="mb-2 col-lg-5 col-md-10 col-sm-9">
                    <label class="form-label">Name:</label>
                    <input class="form-control" placeholder="e.g. Hazim Adel Ahmed Mohammed Al-saqqaf" />
                </div>
                <div class="mb-2 col-lg-5 col-md-10 col-sm-9">
                    <label class="form-label">Gender: </label>
                    <select class="form-select">
                        <option value="Male" selected>Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="mb-2 col-lg-5 col-md-10 col-sm-9">
                    <label class="form-label" >DOB:</label>
                    <input type="date" class="form-control" />
                </div>
                <div class="mb-2 col-lg-5 col-md-10 col-sm-9">
                    <label class="form-label">Regestration Date: </label>
                    <input type="date" class="form-control" placeholder="example@gmail.com">
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="mb-2 col-lg-5 col-md-10 col-sm-9">
                    <label class="form-label">Phone Number:</label>
                    <input type="tel" class="form-control" placeholder="+967 780******" />
                </div>
                <div class="mb-2 col-lg-5 col-md-10 col-sm-9">
                    <label class="form-label">Email:</label>
                    <input type="email" class="form-control" placeholder="example@gmail.com"/>
                </div>
            </div>
<!-- ???? هذا عليك ترجعه لمكانه الصح نسيت اسم الكلاس اللي يعدل مكانه -->
            <div class="row d-flex justify-content-center ">
                <div class="mb-2 col-lg-5 col-md-10 col-sm-9">
                    <label class="form-label">Address:</label>
                    <input type="text" class="form-control" placeholder="Hada street" />
                </div>
                
            </div>
        
            <div class="row d-flex justify-content-lg-start justify-content-md-center justify-content-sm-center">
                <div class="offset-lg-1 col-lg-5 col-md-10 col-sm-9">
                    <a class="btn btn-outline-danger ms-0">Cancel</a>
                    <a class="btn new-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">Update</a>
                </div>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure of the data that you want to add it?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn new-btn fw-bold">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>