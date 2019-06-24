<template>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Bookings</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <router-link tag="a" class="nav-item ml-5 text-white font-weight-bold " to="/">Hotels</router-link>
                <router-link tag="a" class="nav-item ml-3 text-white font-weight-bold" to="/rooms">Rooms</router-link>
            </ul>
        </div>
    </nav>
</template>
