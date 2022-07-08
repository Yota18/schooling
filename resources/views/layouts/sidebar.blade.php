<!-- Sidebar -->
<div class="sidebar sidebar-style-2">			
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary">
                <li class="nav-item active">
                    <a href="{{ route('master.dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">MASTER</h4>
                </li>
                <li class="nav-item">
                    <a href="{{ route('master.jabatan.index') }}">
                        <i class="fas fa-table"></i>
                        <p>Master Jabatan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#admin">
                        <i class="fas fa-shopping-bag"></i>
                        <p>Master User</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="admin">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('master.users.admin.index') }}">
                                    <span class="sub-item">Semua User</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('master.users.staff.index') }}">
                                    <span class="sub-item">Staff</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('master.users.teacher.index') }}">
                                    <span class="sub-item">Guru</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('master.users.student.index') }}">
                                    <span class="sub-item">Siswa</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('master.users.alumni.index') }}">
                                    <span class="sub-item">Alumni</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('master.school.profile.index') }}">
                        <i class="fas fa-table"></i>
                        <p>Profil Sekolah</p>
                    </a>
                </li>
                <li class="nav-item {{  request()->routeIs('master.news.*') ? 'active sub-menu' : '' }}">
                    <a class="" data-toggle="collapse" href="#news" aria-expanded="{{  request()->routeIs('master.news.*') ? 'true' : 'false' }}">
                        <i class="fas fa-newspaper"></i>
                        <p>Berita</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{  request()->routeIs('master.news.*') ? 'show' : '' }}" id="news">
                        <ul class="nav nav-collapse">
                            <li class="{{  request()->routeIs('master.news.*') && !request()->routeIs('master.news.category.*') ? 'active' : '' }}">
                                <a href="{{ route('master.news.index') }}">
                                    <span class="sub-item">Berita</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('master.news.category.*') ? 'active' : '' }}">
                                <a href="{{ route('master.news.category.index') }}">
                                    <span class="sub-item">Kategori Berita</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">AKADEMIK</h4>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#akademik-admin">
                        <i class="fas fa-shopping-bag"></i>
                        <p>Manajemen User</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="akademik-admin">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('akademik.users.admin.index') }}">
                                    <span class="sub-item">Semua User</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('akademik.users.teacher.index') }}">
                                    <span class="sub-item">Guru</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('akademik.users.student.index') }}">
                                    <span class="sub-item">Siswa</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('akademik.users.alumni.index') }}">
                                    <span class="sub-item">Alumni</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#data-master">
                        <i class="fas fa-shopping-bag"></i>
                        <p>Master Data</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="data-master">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('akademik.school.year.index') }}">
                                    <span class="sub-item">Tahuh Ajaran</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('akademik.major.index') }}">
                                    <span class="sub-item">Jurusan</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('akademik.classes.index') }}">
                                    <span class="sub-item">Kelas</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('akademik.mapel.category.index') }}">
                                    <span class="sub-item">Ketegori MaPel</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('akademik.mapel.index') }}">
                                    <span class="sub-item">Mata Pelajaran</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="{{ route('akademik.setting.class.class') }}">
                        <i class="fas fa-table"></i>
                        <p>Pengaturan Kelas</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('akademik.pindah.class.class') }}">
                        <i class="fas fa-table"></i>
                        <p>Pindah/Kenaikan Kelas</p>
                    </a>
                </li>
                
                
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->